<?php
namespace Nueve\ViewPresenter;

/**
 * PhpParser
 */
class PhpParser implements ParserInterface
{
    private $templateDirectory;
    private $fileExt = '.php';

    public function __construct($templateDirectory)
    {
        $this->templateDirectory = rtrim($templateDirectory, DIRECTORY_SEPARATOR);
    }

	private function getTemplatePathname($template)
    {
        if (strpos($template, $this->fileExt) === false) {
            $template = $template . $this->fileExt;
        }
        
        return $this->templateDirectory . DIRECTORY_SEPARATOR .
            ltrim($template, DIRECTORY_SEPARATOR);
    }

	public function render($template, array $data = [])
	{
		$templateFile = $this->getTemplatePathname($template);

		extract($data);
		ob_start();
		require $templateFile;
		return ob_get_clean();
	}
}
