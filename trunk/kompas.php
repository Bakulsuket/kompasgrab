<?php
/*
 * KompasGrab Release - 0.1
 *
 * Copyright (C) 2009 - majalah.linux@gmail.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
*/


  # 1-100, makin tinggi makin baik, ukuran pdf makin besar.
  $quality = 70;
  
  # Perbesaran, Makin besar huruf makin besar
  $density = 150;

################## STOP STOP STOP STOP #############################
$tanggal = $argv[1]; //2009-07-12

if(!$tanggal)
{

  echo "\ncara pakai: php kompas.php [yyyy-mm-dd]\n\ncontoh: php kompas.php 2009-07-12\n\n";
} else
{

  echo "* Buat direktori temp/\n"; 
  `mkdir -p temp`;
  `rm -rf ./temp/*`;

  for($i = 1; $i < 37; $i++)
  {
      flush();
      echo "* Download halaman $i dari 36\n";
     `wget -q -O ./temp/$i.zip --referer=http://epaper.kompas.com --user-agent='Mozilla' 'http://epaper.kompas.com/ClientBin/kompas/$tanggal/Page$i/Page.zip'`;
     `unzip -p ./temp/$i.zip | xsltproc xaml2svg.xsl - | tidy -q -xml - > ./temp/$i.svg`;
  }

echo "\n* Modif SVG\n";

  for($i = 1; $i < 37; $i++)
  {

	$txt='';

        $src=fopen("./temp/$i.svg",'r');
        while($line=fgets($src,8096))
        {       
                $txt.=$line;
        }
        fclose($src);

	$txt = str_replace("<svg width=\"396.8\" height=\"559.36\">", "<svg>" , $txt);
	$txt = str_replace("xmlns:msxsl=\"urn:schemas-microsoft-com:xslt\" overflow=\"visible\"", "xmlns:msxsl=\"urn:schemas-microsoft-com:xslt\" overflow=\"visible\" width=\"396.8\" height=\"559.36\"" , $txt);
	
	$fp = fopen("./temp/modif-$i.svg", 'w');
	fwrite($fp, $txt);
	fclose($fp);  
	`rm -f ./temp/$i.svg`;
    }

echo "\n* Convert JPEG\n";

  for($i = 1; $i < 37; $i++)
  {
      $z = $i;
      if(strlen($z) < 2) $z = "0$i";
      `convert -quiet -antialias -density $density -quality $quality ./temp/modif-$i.svg ./temp/$z.jpg`;
      `rm -f ./temp/modif-$i.svg`;
   }

echo "* Convert pdf..\n";
`convert -quiet ./temp/*.jpg $tanggal-kompas.pdf`;
echo "* Convert $tanggal-kompas.pdf SELESAI\n\n";
}
?>
