> :warning: **2021 notice: It's completely idiotic to use PHP for this task, but as you can see it works lol**
<br/>

# Reddit-DL

This is a simple [PHP](https://www.php.net/) script to download an entire [Reddit](https://reddit.com) subreddit for archiving / [data hoarding](https://www.reddit.com/r/DataHoarder/) purposes. The script makes heavy use of [Pushift.io](https://pushift.io) ([API](https://github.com/pushshift/api)). [youtube-dl](https://ytdl-org.github.io/youtube-dl/index.html) does the video downloads.

It's intended to be used on a windows machine and for rather small subreddits.

## What is getting downloaded

- **Posts** as [JSON](https://www.json.org/json-en.html)
- **Reddit media** attached to posts (Images (i.redd.it), Videos (v.redd.it))
- **Comments** as [JSON](https://www.json.org/json-en.html)

## Usage / Installation

1. Put the `dl.php` on your PHP-enabled webserver
2. Edit the config variables in `dl.php`
3. Open `dl.php` in a browser

## Generated directory structure (Examples)

F:\reddit-dl\2019-09-30 db8evj  
│&nbsp;&nbsp;&nbsp;image.jpg  
│&nbsp;&nbsp;&nbsp;post.json  
│  
└──comments  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f1z4o5p.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f1z5830.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f1z9zdu.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f1zbonk.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f1zsw8u.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f218hsx.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f21xct1.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f286m6f.json  

F:\reddit-dl\2019-09-30 dbbfoc  
&nbsp;&nbsp;&nbsp;&nbsp;post.json  

F:\reddit-dl\2019-09-30 dbhw4z  
│&nbsp;&nbsp;&nbsp;post.json  
│  
└──comments  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f221fxt.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f236hxd.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f23dzkv.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f23hcz9.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f23om96.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f243auk.json  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f245zju.json  
