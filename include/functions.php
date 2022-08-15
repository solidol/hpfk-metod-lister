<?php
// CodeIgniter function: 
function get_dir_file_info($source_dir, $top_level_only = TRUE, $_recursion = FALSE)
{
    static $_filedata = array();
    $relative_path = $source_dir;

    if ($fp = @opendir($source_dir)) {
        // reset the array and make sure $source_dir has a trailing slash on the initial call
        if ($_recursion === FALSE) {
            $_filedata = array();
            $source_dir = rtrim(realpath($source_dir), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        }

        // Used to be foreach (scandir($source_dir, 1) as $file), but scandir() is simply not as fast
        while (FALSE !== ($file = readdir($fp))) {
            if (is_dir($source_dir . $file) && $file[0] !== '.' && $top_level_only === FALSE) {
                get_dir_file_info($source_dir . $file . DIRECTORY_SEPARATOR, $top_level_only, TRUE);
            } elseif ($file[0] !== '.') {
                $_filedata[$file] = get_file_info($source_dir . $file);
                $_filedata[$file]['relative_path'] = $relative_path;
            }
            var_dump($_filedata[$file]);
        }

        closedir($fp);
        return $_filedata;
    }

    return FALSE;
}

// CodeIgniter function:
function get_file_info($file, $returned_values = array('name', 'server_path', 'size', 'date', 'is_file'))
{
    if (!file_exists($file)) {
        return FALSE;
    }

    if (is_string($returned_values)) {
        $returned_values = explode(',', $returned_values);
    }

    foreach ($returned_values as $key) {
        switch ($key) {
            case 'name':
                $fileinfo['name'] = basename($file);
                break;
            case 'server_path':
                $fileinfo['server_path'] = $file;
                break;
            case 'size':
                $fileinfo['size'] = filesize($file);
                break;
            case 'date':
                $fileinfo['date'] = filemtime($file);
                break;
            case 'readable':
                $fileinfo['readable'] = is_readable($file);
                break;
            case 'writable':
                $fileinfo['writable'] = is_really_writable($file);
                break;
            case 'executable':
                $fileinfo['executable'] = is_executable($file);
                break;
            case 'fileperms':
                $fileinfo['fileperms'] = fileperms($file);
                break;
            case 'is_file':
                $fileinfo['is_file'] = (is_file($file)) ? TRUE : FALSE;
                break;
        }
    }

    return $fileinfo;
}


function build_sorter($key)
{
    return function ($a, $b) use ($key) {
        return strnatcasecmp($a[$key], $b[$key]);
    };
}

function detect_file_type($requested_path)
{
    // $pic_file_extensions = array('png', 'jpg', 'jpeg', 'bmp');
    // $markdown_file_extensions = array('md');
    $pic_file_extensions = explode('|', CONST_PICTURE_EXTENSIONS);
    $markdown_file_extensions = explode('|', CONST_MARKDOWN_EXTENSIONS);
    $html_file_extensions = explode('|', CONST_HTML_EXTENSIONS);

    //check for image files first:
    foreach ($pic_file_extensions as $extension) {
        // echo $extension;

        if (mb_substr(mb_strtolower($requested_path), mb_strlen($requested_path) - mb_strlen($extension), mb_strlen($requested_path)) === $extension) {
            return 'PICTURE';
        }
    }

    //check for markdown files:
    foreach ($markdown_file_extensions as $extension) {
        // echo $extension;

        if (mb_substr(mb_strtolower($requested_path), mb_strlen($requested_path) - mb_strlen($extension), mb_strlen($requested_path)) === $extension) {
            return 'MARKDOWN';
        }
    }
    //check for HTML files:
    foreach ($html_file_extensions as $extension) {
        // echo $extension;

        if (mb_substr(mb_strtolower($requested_path), mb_strlen($requested_path) - mb_strlen($extension), mb_strlen($requested_path)) === $extension) {
            return 'HTML';
        }
    }
}


function file_size_human_friendly($file_size)
{
    if ($file_size < 1024) {
        $ret_val = $file_size . ' Bytes';
    } elseif ($file_size < 1048576) {
        $ret_val = round($file_size / 1024, 1) . ' KB';
    } elseif ($file_size < 1073741824) {
        $ret_val = round($file_size / 1048576, 1) . ' MB';
    } else {
        $ret_val = round($file_size / 1073741824, 1) . ' GB';
    }
    //
    return $ret_val;
}


function file_force_download($file)
{
    if (file_exists($file)) {
        // ���������� ����� ������ PHP, ����� �������� ������������ ������ ���������� ��� ������
        // ���� ����� �� ������� ���� ����� �������� � ������ ���������!
        $type = mime_content_type($file);
        //echo iconv("utf-8", "cp1251", addslashes($chroot.$_GET['dir'].$fn));
        //echo addslashes($chroot.$_GET['dir'].$fn);
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        //header('Content-type: '.$type.'; charset=cp1251');
        header('Content-Transfer-Encoding: binary');
        header("Content-Disposition: attachment; filename=" . basename($file));
        $fsize = filesize($file);
        header("Content-Length: " . $fsize);
        ob_clean();
        //print_r($type."123");
        //echo mb_detect_encoding($fn);
        //$file = mb_convert_encoding($file, "cp1251", "UTF-8");
        readfile($file);
        exit();
    }
}
