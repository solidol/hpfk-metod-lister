<?php


if (is_dir($rootPath)) {


    if (isset($_GET['path'])) {
        $requestedPath = $_GET['path'];
        $requestedFullPath = $rootPath . $requestedPath;
        $htmlTitle = $requestedPath . ' - ' . $htmlTitle;
    } else {
        $requestedPath = '';
        $requestedFullPath = $rootPath;
    }
    if (is_dir($requestedFullPath)) {
        $h2Title = ($requestedPath === '') ? 'BROWSE' : $requestedPath;

        $directoryObjects = get_dir_file_info($requestedFullPath, TRUE, FALSE);
        usort($directoryObjects, build_sorter('name'));
    } elseif (is_file($requestedFullPath)) {
        file_force_download($requestedFullPath);
    } else {
        // misspelled URL, redirect to root:
        header('Location: /');
        exit;
    }


    $breadCrumbs = explode('/', $requestedPath);
    $breadCrumbsPath = '';

?>


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php?path=/">Уся база</a></li>
            <?php
            foreach ($breadCrumbs as $bcItem) :
                if ($bcItem) :
                    $breadCrumbsPath .= '/' . $bcItem;
            ?>
                    <li class="breadcrumb-item"><a href="index.php?path=<?= str_replace(['\\', '//'], '/', $breadCrumbsPath) ?>"><?= $bcItem ?></a></li>
            <?php
                endif;
            endforeach;
            ?>
        </ol>
    </nav>

    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Ім'я файла</th>
                    <th>Розмір</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //var_dump($directoryObjects);
                if ($requestedFullPath !== $rootPath && $requestedPath !== '/') : ?>
                    <tr>
                        <td></td>
                        <td><a href="index.php?path=<?= str_replace('\\', '/', dirname($requestedPath)) ?>">..</a></td>
                        <td></td>
                    </tr>
                    <?php
                endif;
                foreach ($directoryObjects as $directoryObject) :
                    if (isset($directoryObject['name'])) :
                        $icon = "img/star.png";
                        $fullFileName = $requestedFullPath . '/' . $directoryObject['name'];
                        $fullFileName = $directoryObject['server_path'];
                        $requestFileName = $requestedPath . '/' . $directoryObject['name'];
                        $requestFileName = str_replace(['\\', '//'], '/', $requestFileName);
                        if (is_dir($fullFileName)) {
                            $icon = "img/folder.png";
                        }
                        if (is_file($fullFileName)) {
                            $icon = "img/document.png";
                        }

                    ?>

                        <tr>
                            <td><img src="<?= $icon ?>"></td>
                            <td><a href="/index.php?path=<?= $requestFileName ?>" title="<?= $directoryObject['name'] ?>"><?= $directoryObject['name'] ?></a></td>
                            <td><?= $directoryObject['is_file'] ? file_size_human_friendly($directoryObject['size']) : "DIR" ?></td>
                        </tr>

                <?php
                    endif;
                endforeach;



                ?>
            </tbody>
        </table>
    </div>
<?php

} else {
?>
    <h2>Не можу підключитися до бд</h2>
<?php
}
