<?php


class View
{
    /**
     * @param string $filename Path of the to-be-rendered view, usually folder/file(.php)
     * @param array $data Data to be used in the view
     */
    public function render($filename, $data = null)
    {
   
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        require Config::get('PATH_VIEW') . 'templates/header.php';
        require Config::get('PATH_VIEW') . $filename . '.php';
        require Config::get('PATH_VIEW') . 'templates/footer.php';
    }
    /**
     * Similar to render, but accepts an array of separate views to render between the header and footer. Use like

     */
    //public function renderMulti($filenames, $data = null)
    //{
    //    if (!is_array($filenames)) {
    //        self::render($filenames, $data);
    //        return false;
    //    }
    //    if ($data) {
    //        foreach ($data as $key => $value) {
    //            $this->{$key} = $value;
    //        }
    //    }
    //    require Config::get('PATH_VIEW') . '_templates/header.php';
    //    foreach($filenames as $filename) {
    //        require Config::get('PATH_VIEW') . $filename . '.php';
    //    }
    //    require Config::get('PATH_VIEW') . '_templates/footer.php';
    //}
    /**
     * Same like render(), but does not include header and footer
     * @param string $filename Path of the to-be-rendered view, usually folder/file(.php)
     * @param mixed $data Data to be used in the view
     */
    public function renderWithoutHeaderAndFooter($filename, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
        require Config::get('PATH_VIEW') . $filename . '.php';
    }

    public function encodeHTML($str)
    {
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }
}
?>