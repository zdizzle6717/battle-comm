<?php

include_once dirname(__FILE__) . '/' . 'utils/file_utils.php';
include_once dirname(__FILE__) . '/' . 'utils/system_utils.php';

include_once dirname(__FILE__) . '/' . 'utils/event.php';
include_once dirname(__FILE__) . '/' . 'utils/sm_datetime.php';
include_once dirname(__FILE__) . '/' . 'utils/link_builder.php';

$formatsMap = array(

    // День
    'd' => 'DD',
    'D' => 'ddd',
    'j' => 'D',
    'l' => 'dddd',
    'N' => 'E',
    // 'S' => '', // Moment.js не поддерживает php "S" - Английский суффикс порядкового числительного дня месяца, 2 символа
    'w' => 'd',
    'z' => 'DDD',

    // Неделя
    'W' => 'W',

    // Месяц
    'F' => 'MMMM',
    'm' => 'MM',
    'M' => 'MMM',
    'n' => 'M',
    // 't' => '', // Moment.js не поддерживает php "t" - Количество дней в указанном месяце

    // Год
    // 'L' => '', // Moment.js не поддерживает php "L" - Признак високосного года
    'o' => 'GGGG',
    'Y' => 'YYYY',
    'y' => 'YY',

    // Время
    'a' => 'a',
    'A' => 'A',
    // 'B' => '', // Moment.js не поддерживает php "B" - Время в формате Интернет-времени (альтернативной системы отсчета времени суток)
    'g' => 'h',
    'G' => 'H',
    'h' => 'hh',
    'H' => 'HH',
    'i' => 'mm',
    's' => 'ss',
    'u' => 'x',

    // Временная зона
    'e' => 'z',
    // 'I' => '', // Moment.js не поддерживает php "I" - Признак летнего времени
    'O' => 'ZZ',
    'P' => 'Z',
    // 'T' => '', // Moment.js не поддерживает php "T" - Аббревиатура временной зоны. Примеры: EST, MDT ...
    // 'Z' => '', // Moment.js не поддерживает php "Z" - Смещение временной зоны в секундах. Для временных зон,
    // расположенных западнее UTC возвращаются отрицательные числа, а расположенных восточнее UTC - положительные.

    // Полная дата/время
    'c' => 'YYYY-MM-DDTHH:mm:ssZ',
    // 'r' => '', // Moment.js не поддерживает php "r" - Дата в формате » RFC 2822 Например: Thu, 21 Dec 2000 16:01:07 +0200
    'U' => 'X'

);

function ServerToClientConvertFormatDate($dateFormat)
{
    global $formatsMap;
    return strtr($dateFormat, $formatsMap);
}

function ClientToServerConvertFormatDate($dateFormat)
{
    global $formatsMap;
    return strtr($dateFormat, array_flip($formatsMap));
}

abstract class ImageFilter
{
    abstract function ApplyFilter(&$imageString, $output = null);
}

class NullFilter extends ImageFilter
{
    function ApplyFilter(&$imageString, $output = null)
    {
        if ($output == null)
            return $imageString;
        else
            file_put_contents($output, $imageString);
    }
}

class ImageFitByWidthResizeFilter extends ImageFilter
{
    private $width;

    public function __construct($width)
    {
        $this->width= $width;
    }

    public function GetTransformedSize($imageSize)
    {
        $imageWidth = $imageSize[0];
        $imageHeight = $imageSize[1];

        $result = array(
            $imageWidth * $this->width / $imageWidth,
            $imageHeight * $this->width / $imageWidth);

        return $result;
    }

    public function echobig($string, $bufferSize = 8192)
    {
        for ($chars = strlen($string) - 1, $start =0 ; $start <= $chars; $start += $bufferSize)
            echo substr($string, $start, $bufferSize);
    }


    public function ApplyFilter(&$imageString, $output = null)
    {
        $image = imagecreatefromstring($imageString);
        $imageSize = array(imagesx($image), imagesy($image));
        $imageWidth = $imageSize[0];
        $imageHeight = $imageSize[1];

        $newImageSize = $this->GetTransformedSize($imageSize);
        $newImageWidth = $newImageSize[0];
        $newImageHeight = $newImageSize[1];

        $result = imagecreatetruecolor($newImageWidth, $newImageHeight);
        imagealphablending($result, false);
        imagesavealpha($result, true);
        $transparent = imagecolorallocatealpha($result, 255, 255, 255, 127);
        imagefilledrectangle($result, 0, 0, $newImageWidth, $newImageHeight, $transparent);

        //ImageUtils::EnableAntiAliasing($result);
        imagecopyresampled($result, $image, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $imageWidth, $imageHeight);
        if ($output == null)
            return imagepng($result);
        else
            imagepng($result, $output);

    }

}

class ImageFitByHeightResizeFilter extends ImageFilter
{
    private $height;

    function __construct($Height)
    {
        $this->height = $Height;
    }

    function GetTransformedSize($imageSize)
    {
        $imageWidth = $imageSize[0];
        $imageHeight = $imageSize[1];

        $result = array(
            $imageWidth * $this->height / $imageHeight,
            $imageHeight * $this->height / $imageHeight);

        return $result;
    }

    function echobig($string, $bufferSize = 8192)
    {
        for ($chars=strlen($string)-1,$start=0;$start <= $chars;$start += $bufferSize)
            echo substr($string,$start,$bufferSize);
    }


    function ApplyFilter(&$imageString, $output = null)
    {
        $image = imagecreatefromstring($imageString);
        $imageSize = array(imagesx($image), imagesy($image));
        $imageWidth = $imageSize[0];
        $imageHeight = $imageSize[1];

        $newImageSize = $this->GetTransformedSize($imageSize);
        $newImageWidth = $newImageSize[0];
        $newImageHeight = $newImageSize[1];

        $result = imagecreatetruecolor($newImageWidth, $newImageHeight);
        ImageUtils::EnableAntiAliasing($result);
        imagecopyresampled($result, $image, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $imageWidth, $imageHeight);

        if ($output == null)
            return imagejpeg($result);
        else
            imagejpeg($result, $output);
    }
}

abstract class HTTPHandler
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function GetName()
    {
        return $this->name;
    }

    public abstract function Render(Renderer $renderer);
}

class DownloadHTTPHandler extends HTTPHandler
{
    /** @var IDataset */
    private $dataset;
    private $fieldName;
    private $contentType;
    private $downloadFileName;

    public function __construct($dataset, $fieldName, $name, $contentType, $downloadFileName, $forceDownload = true)
    {
        parent::__construct($name);
        $this->dataset = $dataset;
        $this->fieldName = $fieldName;
        $this->contentType = $contentType;
        $this->downloadFileName = $downloadFileName;
        $this->forceDownload = $forceDownload;
    }

    public function Render(Renderer $renderer)
    {
        $primaryKeyValues = array();
        ExtractPrimaryKeyValues($primaryKeyValues, METHOD_GET);

        $this->dataset->SetSingleRecordState($primaryKeyValues);
        $this->dataset->Open();
        $result = '';
        if ($this->dataset->Next())
            $result = $this->dataset->GetFieldValueByName($this->fieldName);
        $this->dataset->Close();

        header('Content-type: ' . FormatDatasetFieldsTemplate($this->dataset, $this->contentType));
        if ($this->forceDownload)
            header('Content-Disposition: attachment; filename="' . FormatDatasetFieldsTemplate($this->dataset, $this->downloadFileName) . '"');
        
        echo $result;
    }
}

class ImageHTTPHandler extends HTTPHandler
{
    /** @var IDataset */
    private $dataset;
    private $fieldName;
    /** @var ImageFilter */
    private $imageFilter;

    public function __construct($dataset, $fieldName, $name, $imageFilter)
    {
        parent::__construct($name);
        $this->dataset = $dataset;
        $this->fieldName = $fieldName;
        $this->imageFilter = $imageFilter;
    }

    function TransformImage(&$imageString)
    {
        echo $this->imageFilter->ApplyFilter($imageString);
    }

    public function Render(Renderer $renderer)
    {
        $result = '';
        header('Content-type: image');

        $primaryKeyValues = array ( );
        ExtractPrimaryKeyValues($primaryKeyValues, METHOD_GET);

        $this->dataset->SetSingleRecordState($primaryKeyValues);
        $this->dataset->Open();
        if ($this->dataset->Next())
            $result = $this->dataset->GetFieldValueByName($this->fieldName);
        $this->dataset->Close();

        if (GetApplication()->IsGETValueSet('large'))
            echo $result;
        else
            $this->TransformImage($result);

        return '';
    }
}

class ShowTextBlobHandler extends HTTPHandler
{
    /** @var IDataset */
    private $dataset;
    private $fieldName;
    /** @var Page */
    private $parentPage;
    private $caption;
    private $column;

    public function __construct($dataset, $parentPage, $name, $column)
    {
        parent::__construct($name);
        $this->dataset = $dataset;
        $this->parentPage = $parentPage;
        $this->column = $column;
    }

    public function Render(Renderer $renderer)
    {
        echo $renderer->Render($this);
    }

    public function Accept(Renderer $renderer)
    {
        $renderer->RenderTextBlobViewer($this);
    }

    public function GetParentPage()
    { return $this->parentPage; }

    public function GetCaption()
    {
        return $this->parentPage->RenderText($this->column->GetCaption());
    }

    public function GetValue(Renderer $renderer)
    {
        $result = '';
        $primaryKeyValues = array ( );
        ExtractPrimaryKeyValues($primaryKeyValues, METHOD_GET);

        $this->dataset->SetSingleRecordState($primaryKeyValues);
        $this->dataset->Open();
        if ($this->dataset->Next())
        {
            if ($this->column == null)
                ;//$result = $this->dataset->GetFieldValueByName($this->fieldName);
            else
                $result = $renderer->Render($this->column);
        }
        $this->dataset->Close();
        return $result;
    }
}

class DynamicSearchHandler extends HTTPHandler
{
    /** @var Dataset */
    private $dataset;
    /** @var string */
    private $name;
    /** @var string */
    private $idField;
    /** @var string */
    private $valueField;
    /** @var string */
    private $captionTemplate;

    /**
     * @param Dataset $dataset
     * @param Page|null $parentPage
     * @param string $name
     * @param string $idField
     * @param string $valueField
     * @param string $captionTemplate
     */
    public function __construct($dataset, $parentPage, $name, $idField, $valueField, $captionTemplate)
    {
        parent::__construct($name);
        $this->dataset = $dataset;
        $this->parentPage = null;
        $this->name = $name;
        $this->idField = $idField;
        $this->valueField = $valueField;
        $this->captionTemplate = $captionTemplate;
    }

    private function GetSuperGlobals()
    {
        return GetApplication()->GetSuperGlobals();
    }

    /**
     * @param Renderer $renderer
     * @return void
     */
    public function Render(Renderer $renderer)
    {
        /** @var string $term */
        $term = '';
        if ($this->GetSuperGlobals()->IsGetValueSet('term'))
            $term = $this->GetSuperGlobals()->GetGetValue('term');
        
        if (!StringUtils::IsNullOrEmpty($term)) {
            $this->dataset->AddFieldFilter(
                $this->valueField,
                new FieldFilter('%'.$term.'%', 'ILIKE', true)
            );
        }

        $id = null;
        if ($this->GetSuperGlobals()->IsGetValueSet('id')) {
            $id = $this->GetSuperGlobals()->GetGetValue('id');    
        }

        if (!StringUtils::IsNullOrEmpty($id)) {
            $this->dataset->AddFieldFilter(
                $this->idField,
                FieldFilter::Equals($id)
            );
        }

        header('Content-Type: text/html; charset=utf-8');

        $this->dataset->Open();

        $result = array();
        $valueCount = 0;

        while ($this->dataset->Next())
        {
            $result[] = array(
                "id" => $this->dataset->GetFieldValueByName($this->idField),
                "value" => (
                        StringUtils::IsNullOrEmpty($this->captionTemplate) ?
                        $this->dataset->GetFieldValueByName($this->valueField) :
                        DatasetUtils::FormatDatasetFieldsTemplate($this->dataset, $this->captionTemplate)
                )
            );

            if (++$valueCount >= 20)
                break;
        }

        echo SystemUtils::ToJSON($result);
        
        $this->dataset->Close();
    }
}

class PageHttpHandler extends HTTPHandler
{
    /** @var Page */
    private $page;
    
    public function __construct($name, $page)
    {
        parent::__construct($name);
        $this->page = $page;
    }
    
    public function Render(Renderer $renderer)
    {
        $this->page->BeginRender();
        $this->page->EndRender();
    }

    public function getPage() {
        return $this->page;
    }
}

?>