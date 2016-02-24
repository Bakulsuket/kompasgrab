**Requirement**: gnu/linux operating system, php-cli, unzip, inkscape, tidy, imagemagick

To meet the requirements, please run:

  * on Ubuntu : **sudo apt-get install php5-cli unzip tidy inkscape imagemagick**
  * on Mandriva (root) : **urpmi php-cli unzip tidy inkscape imagemagick**
  * on openSuSE : **zypper in php5 unzip tidy inkscape imagemagick** or **yast -i php5 unzip tidy inkscape imagemagick**
  * on Mac : click http://code.google.com/p/kompasgrab/wiki/forMac

**How to use?**

  1. Extract first: tar zxvf kompasgrab-01.tar.gz
  1. open console
  1. run script with this command:
    * php kompas.php --> for help
    * php kompas.php [yyyy-mm-dd] --> for grabbing kompas epaper based on date


To improve quality of the pdf output, try edit kompas.php and change
this variables value:
  * $quality = 70;
  * $density = 150;

If your pdf output file size is more than 10 MB, please try to use my "convert" application (originally from mandriva 2009.1 default package) that you can download here http://jawaposgrab.googlecode.com/files/convert-best-compression-6.5.0-2.tar.bz2

Please extract, use this command
  * Ubuntu : sudo tar jxvf convert-best-compression-6.5.0-2.tar.bz2 -C /
  * Mandriva and other linux distribution (root) : tar jxvf convert-best-compression-6.5.0-2.tar.bz2 -C /

If you have troube / error related with minimum php memory, please edit your php.ini file. Find with this command:

  * $ locate php.ini
  * /etc/php.ini
  * sudo nano /etc/php.ini
  * change memory\_limit = 32M to memory\_limit = 64M or bigger
  * save
  * try again.

Sample:

![http://baliwae.com/images/kompasgrab-shot1.jpeg](http://baliwae.com/images/kompasgrab-shot1.jpeg)