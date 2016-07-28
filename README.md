# MovingTool 

 [![GitHub issues](https://img.shields.io/github/issues/Stormiix/MovingTool.svg?style=flat-square)](https://github.com/Stormiix/MovingTool/issues)
[![GitHub forks](https://img.shields.io/github/forks/Stormiix/MovingTool.svg?style=flat-square)](https://github.com/Stormiix/MovingTool/network)
[![GitHub stars](https://img.shields.io/github/stars/Stormiix/MovingTool.svg?style=flat-square)](https://github.com/Stormiix/MovingTool/stargazers)
[![Twitter](https://img.shields.io/twitter/url/https/github.com/Stormiix/MovingTool/.svg?style=social?style=flat-square)](https://twitter.com/intent/tweet?text=Wow:&url=%5Bobject%20Object%5D)
 
This tool is one of the most handy tools I've ever built , it helped me move +1000 Website from host to host , usually , when I build something for my clients , it's under <b>https://Stormix.co/Projects/PROJECTNAME</b> but when the clients likes it , I'de usually need to move it to a his host and for some websites the size can go up to +100 MB ( and even more, I had to move a 2GB website once..), which is tiring to download & re-upload via FTP (Especially if you have a slow internet connection like mine). <br>So I built this tool , I only need to compress all the files, add a direct download link of that zip to the PHP file and let it handle the rest.
<br>That's it !

If you have problems, first search for a similiar issue and then report with [new one](https://github.com/Stormiix/MovingTool/issues).
 

# Installation
Just upload the <b>move.php</b> file to where your want your files move.
(For example, if you want to move a website from SERVER1 to SERVER2 , upload **move.php** to SERVER2)
 
# Configuring the tool

1. Open the php file with your favorite code editor .
2. Go to **line : 24**

```php
//Config Me
$path = 'dummy.jpg'; //The path where to save the downloaded file.
$url = 'https://stormix.co/dummy.jpg'; //The file to download
```
3. Replace ** dummy.jpg ** with the path where to save the downloaded file.<br> Replace ** https://stormix.co/dummy.jpg ** with a direct link to the file you want to download.

**NOTE:** - This tool doesn't handle the database migration , it just move files , you'll need to do that manually.

# How to use 
Let's say you want to move Example1.com to Example2.com
1. Open your CPanel and go to your file manager, inside the folder `public_html` are your websites files.
2. Compress all those file into a single ZIP file. (You can do that on most CPanels)
3. Rename that zip file to whatever you want , **backup.zip** for example
4. On your PC , open **move.php** with your favorite code editor and changes lines `24`&`26`.<br>
```php
$path = 'backup.zip'; //The path where to save the downloaded file.
$url = 'http://example1.com/backup.zip'; //The file to download
```
5. Now upload **move.php** to your new website "example2.com" inside the `public_html` folder.
6. Open your browser , and visit this url : http://example2.com/move.php . 
**NOTE:** - Large files will take time to move , so don't close the windows until you see this  : <br>
![Splash Page](https://i.imgur.com/jHx4o24.png)
7. When it's done , go to the file manager and extract the Zipped file & THAT'S IT ! 
 
# Known issues
None for now.
  
# Resources
**Materialize CSS**
[Materialize](http://materializecss.com/) Materialize CSS.<br>


 
 
