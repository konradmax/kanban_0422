<?php


namespace Max\Dashboard;

class View {
    protected $content;

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function render($template="layout",$content = null)
    {
        if(null===$content) {
            $content = $this->content;
        }
        ob_start();
        require_once(sprintf("templates/%s.php",$template));
        $html = ob_get_clean();
        return $html;
    }
}