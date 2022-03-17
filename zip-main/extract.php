<?php
function getDirectory($path = '.', $level = 0)
{
    $ignore = array('.', '..');
    // Directories to ignore when listing output. Many hosts 
    // will deny PHP access to the cgi-bin.
    $dh = @opendir($path);
    // Open the directory to the 2handle $dh 
    while (false !== ($file = readdir($dh))) {
        // Loop through the directory 
        if (!in_array($file, $ignore)) {
            // Check that this file is not to be ignored 
            // $spaces = str_repeat( '&nbsp;', ( $level * 4 ) ); 
            // Just to add spacing to the list, to better 
            // show the directory tree. 
            if (is_dir("$path/$file")) {
                // Its a directory, so we need to keep reading down... 
                getDirectory("$path/$file", ($level + 1));
                // Re-call this same function but on a new directory. 
                // this is what makes function recursive. 
            } else {
                $ex = explode('.', $file);
                $ex = end($ex);
                if ($ex == 'png' || $ex == 'jpg' || $ex == 'svg') {
                    echo "<img src=\"$path/$file\" alt= srcset=>";
                } else if ($ex == 'mp4') {
                    echo "  <video width='320' height='240' controls autoplay>
                                <source src=\"$path/$file\" type='video/mp4'>
                            </video>";
                } else if ($ex == 'mp3') {
                    echo "  <audio width='320' height='240' controls autoplay>
                               <source src=\"$path/$file\" type='video/mp3'>
                               <source src=\"$path/$file\" type='video/ogg'>
                            </audio>";
                } else {
                    echo "<div class='file'>
                            <a href=\"$path/$file\">
                            <img src='file.png'/>
                            <p>$file</p>
                            </a>
                            </div>";
                }
            }
        }
    }
}
