# PHP google webfont downloader

I put this together to facilitate the use of google webfonts localy.

In the input folder create a css file called fonts.css, then copy and paste the contents of the css file imported from 
google webfont (ex : "https://fonts.googleapis.com/css?family=Dancing+Script:400,700|Lato:400,700,900|Montserrat:300,400,500,600,700,900")

run php index.php and in the output folder you should now see a fonts directory with all your fonts
aswell as a fonts.css and a _fonts.scss file containing the correct fiel path to use the fonts locally.

Depending on the structure of you site you can modify the $font_dir variable in index.php to suit your needs.
