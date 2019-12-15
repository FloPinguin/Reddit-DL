<?php
    ini_set('max_execution_time', '600');

    //CONFIG
    $dl_location = 'F:/reddit-dl'; // Download location
    $subreddit = "laesterschwestern";
    $increment = 20; // According to the documentation, Pushift does not return more than 500 submissions (posts) per call. So we usually can't get all subreddit posts with one pushift call. The solution is: We iterate through periods of time (n days). For example: I think, in 20 days, less than 500 posts are getting created in subreddit x. So I enter "$increment = 20". What are the downsides of using a small $increment like "1"? Pushift will be called more often. The process will take more time.
    $youtube_dl_location = 'F: && cd "F:\Program Files\youtube-dl\"'; // CMD command for switching to your youtue-dl directory (Where the youtube-dl.exe is stored). We need youtube-dl for reddit video downloads with sound.

    // already downloaded
    $already_downloaded = file_get_contents("already-downloaded.txt");

    // posts
    for($d = 0; ; $d += $increment){
        output("Requesting day ".$d." to ".($d + $increment));
        $posts_fgc = file_get_contents("https://api.pushshift.io/reddit/search/submission/?subreddit=".$subreddit."&size=1000&sort=desc&before=".$d."d&after=".($d + $increment)."d");
        $posts = json_decode($posts_fgc, true)['data'];
        if ($posts_fgc !== false && empty($posts)){
            die("End reached. Done!");
        }

        for($i = 0; $i < sizeof($posts); $i++){
            if (strpos($already_downloaded, $posts[$i]['id']) !== false) {
                continue;
            }

            unset($comment_ids_fgc, $comments_fgc);
            $folderpath = $dl_location."/".date("Y-m-d", $posts[$i]['created_utc'])." ".$posts[$i]['id'];

            // post
            if (!file_exists($folderpath)) {
                mkdir($folderpath, 0777, true);
                output($folderpath." (Directory created)");
            }
            if (!file_exists($folderpath."/post.json")) {
                file_put_contents($folderpath."/post.json", json_encode($posts[$i], JSON_PRETTY_PRINT));
                output($folderpath."/post.json (File written)");
            }

            // image
            if ($posts[$i]['is_reddit_media_domain'] && !file_exists($folderpath."/image.jpg")){
                $image = @file_get_contents($posts[$i]['url']);
                if (!empty($image)){
                    file_put_contents($folderpath."/image.jpg", $image);
                    output($folderpath."/image.jpg (File written)");
                }
            }

            // video
            if ($posts[$i]['is_video'] && !file_exists($folderpath."/video.mp4")){
                output(shell_exec($youtube_dl_location.' && youtube-dl.exe -o "'.$folderpath.'/video.mp4" '.$posts[$i]['full_link']));
            }

            // comments
            $comment_ids_fgc = file_get_contents("https://api.pushshift.io/reddit/submission/comment_ids/".$posts[$i]['id']);
            $comment_ids = json_decode($comment_ids_fgc, true)['data'];
            if (sizeof($comment_ids) > 0){
                if (!file_exists($folderpath."/comments")) {
                    mkdir($folderpath."/comments", 0777, true);
                    output($folderpath."/comments (Directory created)");
                }

                $comment_ids_concat = "";
                for($a = 0; $a < sizeof($comment_ids); $a++){
                    $comment_ids_concat = $comment_ids_concat.$comment_ids[$a].",";
                }
                $comment_ids_concat = substr($comment_ids_concat, 0, -1);

                // comment
                $comments_fgc = file_get_contents("https://api.pushshift.io/reddit/search/comment/?ids=".$comment_ids_concat);
                $comments = json_decode($comments_fgc, true)['data'];
                for($a = 0; $a < sizeof($comments); $a++){
                    if (!file_exists($folderpath."/comments/".$comments[$a]['id'].".json")) {
                        file_put_contents($folderpath."/comments/".$comments[$a]['id'].".json", json_encode($comments[$a], JSON_PRETTY_PRINT));
                        output($folderpath."/comments/".$comments[$a]['id']." (File written)");
                    }
                }
            }

            // Successful download?
            if ($comment_ids_fgc !== false && (!isset($comments_fgc) || $comments_fgc !== false)){
                file_put_contents("already-downloaded.txt", $posts[$i]['id'].",", FILE_APPEND);
                output("Successfully downloaded: ".$posts[$i]['id']);
            }else{
                output("Partially failed download: ".$posts[$i]['id']);
            }
        }
    }

    function output($msg){
        echo $msg."<br>";
        ob_flush();
        flush();
    }
?>