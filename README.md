# Reddit-DL

This is a simple [PHP](https://www.php.net/) script to download an entire [Reddit](https://reddit.com) subreddit for archiving / [data hoarding](https://www.reddit.com/r/DataHoarder/) purposes. The script makes heavy use of [Pushift.io](https://pushift.io) ([API](https://github.com/pushshift/api)). [youtube-dl](https://ytdl-org.github.io/youtube-dl/index.html) does the video downloads.

It's intended to be used on a windows machine and for rather small subreddits.

## What is getting downloaded

- **Posts** as [JSON](https://www.json.org/json-en.html)
- **Reddit media** attached to posts (Images (i.redd.it), Videos (v.redd.it))
- **Comments** as [JSON](https://www.json.org/json-en.html)

## Usage / Installation

1. Put the `dl.php` and a "dl" folder on your PHP-enabled webserver
2. Edit the config variables in `dl.php`
3. Open `dl.php` in a browser and see your `dl` folder getting filled
