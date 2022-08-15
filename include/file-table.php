<?php

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

?>
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

        foreach ($directoryObjects as $directoryObject) :
            if (isset($directoryObject['name'])) :
                $icon = "img/star.png";
                $fullFileName = $requestedFullPath . '/' . basename($directoryObject['name']);
                $requestFileName = $requestedPath . '/' . basename($directoryObject['name']);
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
                    <td><a href="/index.php?path=<?= $requestFileName ?>" title="<?= basename($directoryObject['name']) ?>"><?= basename($directoryObject['name']) ?></a></td>
                    <td><?= file_size_human_friendly($directoryObject['size']) ?></td>
                </tr>

        <?php
            endif;
        endforeach;


        if ($requestedFullPath !== $rootPath && $requestedPath !== '/') {
            echo '<a href="/index.php?path=' . str_replace('\\', '/', dirname($requestedPath)) . '">..</a><br />';
        }
        ?>
    </tbody>
</table>