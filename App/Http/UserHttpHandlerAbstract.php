<?php


namespace App\Http;


use Core\TemplateInterface;

class UserHttpHandlerAbstract
{
    private TemplateInterface $template;

    public function __construct(TemplateInterface $template)
    {
        $this->template = $template;
    }

    public function render(string $templateName, $data = null): void
    {
        $this->template->render($templateName, $data);
    }

    public function redirect(string $url): void
    {
        header("Location: $url");
    }
}