<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */


    include_once dirname(__FILE__) . '/' . 'components/utils/check_utils.php';
    CheckPHPVersion();
    CheckTemplatesCacheFolderIsExistsAndWritable();


    include_once dirname(__FILE__) . '/' . 'phpgen_settings.php';
    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page.php';


    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthorizationStrategy()->ApplyIdentityToConnectionOptions($result);
        return $result;
    }

    
    // OnGlobalBeforePageExecute event handler
    
    
    // OnBeforePageExecute event handler
    
    
    
    class productsPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MySqlIConnectionFactory(),
                GetConnectionOptions(),
                '`products`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('SKU');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('updated');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('name');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('price');
            $this->dataset->AddField($field, false);
            $field = new StringField('description');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('manufacturerId');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('gameSystem');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('color');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('tag');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('category');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('stockQty');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('inStock');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('filterVal');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('displayStatus');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('featured');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('new');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('onSale');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('imgOneFront');
            $this->dataset->AddField($field, false);
            $field = new StringField('imgOneBack');
            $this->dataset->AddField($field, false);
            $field = new StringField('imgOneAlt');
            $this->dataset->AddField($field, false);
            $field = new StringField('imgTwoFront');
            $this->dataset->AddField($field, false);
            $field = new StringField('imgTwoBack');
            $this->dataset->AddField($field, false);
            $field = new StringField('imgTwoAlt');
            $this->dataset->AddField($field, false);
            $field = new StringField('imgThreeFront');
            $this->dataset->AddField($field, false);
            $field = new StringField('imgThreeBack');
            $this->dataset->AddField($field, false);
            $field = new StringField('imgThreeAlt');
            $this->dataset->AddField($field, false);
            $field = new StringField('imgFourFront');
            $this->dataset->AddField($field, false);
            $field = new StringField('imgFourBack');
            $this->dataset->AddField($field, false);
            $field = new StringField('imgFourAlt');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('category', 'game_categories', new IntegerField('game_cat_id', null, null, true), new StringField('game_category', 'category_game_category', 'category_game_category_game_categories'), 'category_game_category_game_categories');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('productsssearch', $this->dataset,
                array('id', 'SKU', 'updated', 'name', 'price', 'description', 'manufacturerId', 'gameSystem', 'color', 'tag', 'category_game_category', 'stockQty', 'inStock', 'filterVal', 'displayStatus', 'featured', 'new', 'onSale', 'imgOneFront', 'imgOneBack', 'imgOneAlt', 'imgTwoFront', 'imgTwoBack', 'imgTwoAlt', 'imgThreeFront', 'imgThreeBack', 'imgThreeAlt', 'imgFourFront', 'imgFourBack', 'imgFourAlt'),
                array($this->RenderText('Id'), $this->RenderText('SKU'), $this->RenderText('Updated'), $this->RenderText('Name'), $this->RenderText('Price'), $this->RenderText('Description'), $this->RenderText('ManufacturerId'), $this->RenderText('GameSystem'), $this->RenderText('Color'), $this->RenderText('Tag'), $this->RenderText('Category'), $this->RenderText('StockQty'), $this->RenderText('InStock'), $this->RenderText('FilterVal'), $this->RenderText('Display Status'), $this->RenderText('Featured'), $this->RenderText('New'), $this->RenderText('OnSale'), $this->RenderText('ImgOneFront'), $this->RenderText('ImgOneBack'), $this->RenderText('ImgOneAlt'), $this->RenderText('ImgTwoFront'), $this->RenderText('ImgTwoBack'), $this->RenderText('ImgTwoAlt'), $this->RenderText('ImgThreeFront'), $this->RenderText('ImgThreeBack'), $this->RenderText('ImgThreeAlt'), $this->RenderText('ImgFourFront'), $this->RenderText('ImgFourBack'), $this->RenderText('ImgFourAlt')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('productsasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('id', $this->RenderText('Id')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('SKU', $this->RenderText('SKU')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('updated', $this->RenderText('Updated'), 'Y-m-d H:i:s'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('name', $this->RenderText('Name')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('price', $this->RenderText('Price')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('description', $this->RenderText('Description')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('manufacturerId', $this->RenderText('ManufacturerId')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('gameSystem', $this->RenderText('GameSystem')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('color', $this->RenderText('Color')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('tag', $this->RenderText('Tag')));
            
            $lookupDataset = new TableDataset(
                new MySqlIConnectionFactory(),
                GetConnectionOptions(),
                '`game_categories`');
            $field = new IntegerField('game_cat_id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('game_category');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('WinPointValue');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('lossPointValue');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('drawPointValue');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('game_category', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('category', $this->RenderText('Category'), $lookupDataset, 'game_cat_id', 'game_category', false, 8));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('stockQty', $this->RenderText('StockQty')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('inStock', $this->RenderText('InStock')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('filterVal', $this->RenderText('FilterVal')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('displayStatus', $this->RenderText('Display Status')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('featured', $this->RenderText('Featured')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('new', $this->RenderText('New')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('onSale', $this->RenderText('OnSale')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgOneFront', $this->RenderText('ImgOneFront')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgOneBack', $this->RenderText('ImgOneBack')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgOneAlt', $this->RenderText('ImgOneAlt')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgTwoFront', $this->RenderText('ImgTwoFront')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgTwoBack', $this->RenderText('ImgTwoBack')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgTwoAlt', $this->RenderText('ImgTwoAlt')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgThreeFront', $this->RenderText('ImgThreeFront')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgThreeBack', $this->RenderText('ImgThreeBack')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgThreeAlt', $this->RenderText('ImgThreeAlt')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgFourFront', $this->RenderText('ImgFourFront')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgFourBack', $this->RenderText('ImgFourBack')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('imgFourAlt', $this->RenderText('ImgFourAlt')));
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for SKU field
            //
            $column = new TextViewColumn('SKU', 'SKU', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'Updated', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for price field
            //
            $column = new TextViewColumn('price', 'Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_description_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for manufacturerId field
            //
            $column = new TextViewColumn('manufacturerId', 'ManufacturerId', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for gameSystem field
            //
            $column = new TextViewColumn('gameSystem', 'GameSystem', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for color field
            //
            $column = new TextViewColumn('color', 'Color', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for tag field
            //
            $column = new TextViewColumn('tag', 'Tag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_tag_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for game_category field
            //
            $column = new TextViewColumn('category_game_category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for stockQty field
            //
            $column = new TextViewColumn('stockQty', 'StockQty', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for inStock field
            //
            $column = new TextViewColumn('inStock', 'InStock', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for filterVal field
            //
            $column = new TextViewColumn('filterVal', 'FilterVal', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for displayStatus field
            //
            $column = new TextViewColumn('displayStatus', 'Display Status', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for featured field
            //
            $column = new TextViewColumn('featured', 'Featured', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for new field
            //
            $column = new TextViewColumn('new', 'New', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for onSale field
            //
            $column = new TextViewColumn('onSale', 'OnSale', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgOneFront field
            //
            $column = new TextViewColumn('imgOneFront', 'ImgOneFront', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgOneFront_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgOneBack field
            //
            $column = new TextViewColumn('imgOneBack', 'ImgOneBack', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgOneBack_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgOneAlt field
            //
            $column = new TextViewColumn('imgOneAlt', 'ImgOneAlt', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgOneAlt_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgTwoFront field
            //
            $column = new TextViewColumn('imgTwoFront', 'ImgTwoFront', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgTwoFront_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgTwoBack field
            //
            $column = new TextViewColumn('imgTwoBack', 'ImgTwoBack', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgTwoBack_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgTwoAlt field
            //
            $column = new TextViewColumn('imgTwoAlt', 'ImgTwoAlt', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgTwoAlt_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgThreeFront field
            //
            $column = new TextViewColumn('imgThreeFront', 'ImgThreeFront', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgThreeFront_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgThreeBack field
            //
            $column = new TextViewColumn('imgThreeBack', 'ImgThreeBack', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgThreeBack_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgThreeAlt field
            //
            $column = new TextViewColumn('imgThreeAlt', 'ImgThreeAlt', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgThreeAlt_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgFourFront field
            //
            $column = new TextViewColumn('imgFourFront', 'ImgFourFront', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgFourFront_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgFourBack field
            //
            $column = new TextViewColumn('imgFourBack', 'ImgFourBack', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgFourBack_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for imgFourAlt field
            //
            $column = new TextViewColumn('imgFourAlt', 'ImgFourAlt', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgFourAlt_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for SKU field
            //
            $column = new TextViewColumn('SKU', 'SKU', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'Updated', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for price field
            //
            $column = new TextViewColumn('price', 'Price', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_description_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for manufacturerId field
            //
            $column = new TextViewColumn('manufacturerId', 'ManufacturerId', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for gameSystem field
            //
            $column = new TextViewColumn('gameSystem', 'GameSystem', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for color field
            //
            $column = new TextViewColumn('color', 'Color', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for tag field
            //
            $column = new TextViewColumn('tag', 'Tag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_tag_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for game_category field
            //
            $column = new TextViewColumn('category_game_category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for stockQty field
            //
            $column = new TextViewColumn('stockQty', 'StockQty', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for inStock field
            //
            $column = new TextViewColumn('inStock', 'InStock', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for filterVal field
            //
            $column = new TextViewColumn('filterVal', 'FilterVal', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for displayStatus field
            //
            $column = new TextViewColumn('displayStatus', 'Display Status', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for featured field
            //
            $column = new TextViewColumn('featured', 'Featured', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for new field
            //
            $column = new TextViewColumn('new', 'New', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for onSale field
            //
            $column = new TextViewColumn('onSale', 'OnSale', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgOneFront field
            //
            $column = new TextViewColumn('imgOneFront', 'ImgOneFront', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgOneFront_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgOneBack field
            //
            $column = new TextViewColumn('imgOneBack', 'ImgOneBack', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgOneBack_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgOneAlt field
            //
            $column = new TextViewColumn('imgOneAlt', 'ImgOneAlt', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgOneAlt_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgTwoFront field
            //
            $column = new TextViewColumn('imgTwoFront', 'ImgTwoFront', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgTwoFront_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgTwoBack field
            //
            $column = new TextViewColumn('imgTwoBack', 'ImgTwoBack', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgTwoBack_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgTwoAlt field
            //
            $column = new TextViewColumn('imgTwoAlt', 'ImgTwoAlt', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgTwoAlt_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgThreeFront field
            //
            $column = new TextViewColumn('imgThreeFront', 'ImgThreeFront', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgThreeFront_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgThreeBack field
            //
            $column = new TextViewColumn('imgThreeBack', 'ImgThreeBack', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgThreeBack_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgThreeAlt field
            //
            $column = new TextViewColumn('imgThreeAlt', 'ImgThreeAlt', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgThreeAlt_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgFourFront field
            //
            $column = new TextViewColumn('imgFourFront', 'ImgFourFront', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgFourFront_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgFourBack field
            //
            $column = new TextViewColumn('imgFourBack', 'ImgFourBack', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgFourBack_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imgFourAlt field
            //
            $column = new TextViewColumn('imgFourAlt', 'ImgFourAlt', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('productsGrid_imgFourAlt_handler_view');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for SKU field
            //
            $editor = new TextEdit('sku_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('SKU', 'SKU', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated field
            //
            $editor = new DateTimeEdit('updated_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated', 'updated', $editor, $this->dataset);
            $editColumn->setVisible(false);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(80);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for price field
            //
            $editor = new TextEdit('price_edit');
            $editColumn = new CustomEditColumn('Price', 'price', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for manufacturerId field
            //
            $editor = new TextEdit('manufacturerid_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('ManufacturerId', 'manufacturerId', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for gameSystem field
            //
            $editor = new TextEdit('gamesystem_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('GameSystem', 'gameSystem', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for color field
            //
            $editor = new TextEdit('color_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Color', 'color', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for tag field
            //
            $editor = new TextAreaEdit('tag_edit', 50, 8);
            $editColumn = new CustomEditColumn('Tag', 'tag', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for category field
            //
            $editor = new ComboBox('category_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MySqlIConnectionFactory(),
                GetConnectionOptions(),
                '`game_categories`');
            $field = new IntegerField('game_cat_id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('game_category');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('WinPointValue');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('lossPointValue');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('drawPointValue');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('game_category', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Category', 
                'category', 
                $editor, 
                $this->dataset, 'game_cat_id', 'game_category', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for stockQty field
            //
            $editor = new TextEdit('stockqty_edit');
            $editColumn = new CustomEditColumn('StockQty', 'stockQty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for inStock field
            //
            $editor = new ComboBox('instock_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue($this->RenderText('1'), $this->RenderText('Yes'));
            $editor->AddValue($this->RenderText('0'), $this->RenderText('No'));
            $editColumn = new CustomEditColumn('InStock', 'inStock', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for filterVal field
            //
            $editor = new ComboBox('filterval_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue($this->RenderText('showit'), $this->RenderText('Show It'));
            $editor->AddValue($this->RenderText('hideit'), $this->RenderText('Hide It'));
            $editColumn = new CustomEditColumn('FilterVal', 'filterVal', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for displayStatus field
            //
            $editor = new TextEdit('displaystatus_edit');
            $editColumn = new CustomEditColumn('Display Status', 'displayStatus', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for featured field
            //
            $editor = new TextEdit('featured_edit');
            $editColumn = new CustomEditColumn('Featured', 'featured', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for new field
            //
            $editor = new TextEdit('new_edit');
            $editColumn = new CustomEditColumn('New', 'new', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for onSale field
            //
            $editor = new TextEdit('onsale_edit');
            $editColumn = new CustomEditColumn('OnSale', 'onSale', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgOneFront field
            //
            $editor = new ImageUploader('imgonefront_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgOneFront', 'imgOneFront', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgOneFront_GenerateFileName_edit', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgOneFront',
                'upload/%id%/',
                Delegate::CreateFromMethod($this, 'imgOneFront_Thumbnail_GenerateFileName_edit'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgOneBack field
            //
            $editor = new ImageUploader('imgoneback_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgOneBack', 'imgOneBack', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgOneBack_GenerateFileName_edit', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgOneBack',
                'upload/%id%/',
                Delegate::CreateFromMethod($this, 'imgOneBack_Thumbnail_GenerateFileName_edit'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgOneAlt field
            //
            $editor = new TextEdit('imgonealt_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('ImgOneAlt', 'imgOneAlt', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgTwoFront field
            //
            $editor = new ImageUploader('imgtwofront_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgTwoFront', 'imgTwoFront', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgTwoFront_GenerateFileName_edit', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgTwoFront',
                '',
                Delegate::CreateFromMethod($this, 'imgTwoFront_Thumbnail_GenerateFileName_edit'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgTwoBack field
            //
            $editor = new ImageUploader('imgtwoback_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgTwoBack', 'imgTwoBack', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgTwoBack_GenerateFileName_edit', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgTwoBack',
                'upload/%id%/ ',
                Delegate::CreateFromMethod($this, 'imgTwoBack_Thumbnail_GenerateFileName_edit'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgTwoAlt field
            //
            $editor = new TextEdit('imgtwoalt_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('ImgTwoAlt', 'imgTwoAlt', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgThreeFront field
            //
            $editor = new ImageUploader('imgthreefront_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgThreeFront', 'imgThreeFront', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgThreeFront_GenerateFileName_edit', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgThreeFront',
                'upload/%id%/ ',
                Delegate::CreateFromMethod($this, 'imgThreeFront_Thumbnail_GenerateFileName_edit'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgThreeBack field
            //
            $editor = new ImageUploader('imgthreeback_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgThreeBack', 'imgThreeBack', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgThreeBack_GenerateFileName_edit', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgThreeBack',
                'upload/%id%/ ',
                Delegate::CreateFromMethod($this, 'imgThreeBack_Thumbnail_GenerateFileName_edit'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgThreeAlt field
            //
            $editor = new TextEdit('imgthreealt_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('ImgThreeAlt', 'imgThreeAlt', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgFourFront field
            //
            $editor = new ImageUploader('imgfourfront_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgFourFront', 'imgFourFront', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgFourFront_GenerateFileName_edit', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgFourFront',
                'upload/%id%/ ',
                Delegate::CreateFromMethod($this, 'imgFourFront_Thumbnail_GenerateFileName_edit'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgFourBack field
            //
            $editor = new ImageUploader('imgfourback_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgFourBack', 'imgFourBack', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgFourBack_GenerateFileName_edit', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgFourBack',
                'upload/%id%/ ',
                Delegate::CreateFromMethod($this, 'imgFourBack_Thumbnail_GenerateFileName_edit'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imgFourAlt field
            //
            $editor = new TextEdit('imgfouralt_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('ImgFourAlt', 'imgFourAlt', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for SKU field
            //
            $editor = new TextEdit('sku_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('SKU', 'SKU', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated field
            //
            $editor = new DateTimeEdit('updated_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated', 'updated', $editor, $this->dataset);
            $editColumn->setVisible(false);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetAllowSetToDefault(true);
            $editColumn->SetInsertDefaultValue($this->RenderText('%CURRENT_DATETIME%'));
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(80);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for price field
            //
            $editor = new TextEdit('price_edit');
            $editColumn = new CustomEditColumn('Price', 'price', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for manufacturerId field
            //
            $editor = new TextEdit('manufacturerid_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('ManufacturerId', 'manufacturerId', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for gameSystem field
            //
            $editor = new TextEdit('gamesystem_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('GameSystem', 'gameSystem', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for color field
            //
            $editor = new TextEdit('color_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Color', 'color', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for tag field
            //
            $editor = new TextAreaEdit('tag_edit', 50, 8);
            $editColumn = new CustomEditColumn('Tag', 'tag', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for category field
            //
            $editor = new ComboBox('category_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MySqlIConnectionFactory(),
                GetConnectionOptions(),
                '`game_categories`');
            $field = new IntegerField('game_cat_id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('game_category');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('WinPointValue');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('lossPointValue');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('drawPointValue');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('game_category', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Category', 
                'category', 
                $editor, 
                $this->dataset, 'game_cat_id', 'game_category', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for stockQty field
            //
            $editor = new TextEdit('stockqty_edit');
            $editColumn = new CustomEditColumn('StockQty', 'stockQty', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for inStock field
            //
            $editor = new ComboBox('instock_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue($this->RenderText('1'), $this->RenderText('Yes'));
            $editor->AddValue($this->RenderText('0'), $this->RenderText('No'));
            $editColumn = new CustomEditColumn('InStock', 'inStock', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetAllowSetToDefault(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for filterVal field
            //
            $editor = new ComboBox('filterval_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue($this->RenderText('showit'), $this->RenderText('Show It'));
            $editor->AddValue($this->RenderText('hideit'), $this->RenderText('Hide It'));
            $editColumn = new CustomEditColumn('FilterVal', 'filterVal', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetAllowSetToDefault(true);
            $editColumn->SetInsertDefaultValue($this->RenderText('showit'));
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for displayStatus field
            //
            $editor = new TextEdit('displaystatus_edit');
            $editColumn = new CustomEditColumn('Display Status', 'displayStatus', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetAllowSetToDefault(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for featured field
            //
            $editor = new TextEdit('featured_edit');
            $editColumn = new CustomEditColumn('Featured', 'featured', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetAllowSetToDefault(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for new field
            //
            $editor = new TextEdit('new_edit');
            $editColumn = new CustomEditColumn('New', 'new', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetAllowSetToDefault(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for onSale field
            //
            $editor = new TextEdit('onsale_edit');
            $editColumn = new CustomEditColumn('OnSale', 'onSale', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetAllowSetToDefault(true);
            $editColumn->SetInsertDefaultValue($this->RenderText('0'));
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgOneFront field
            //
            $editor = new ImageUploader('imgonefront_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgOneFront', 'imgOneFront', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgOneFront_GenerateFileName_insert', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgOneFront',
                'upload/%id%/',
                Delegate::CreateFromMethod($this, 'imgOneFront_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgOneBack field
            //
            $editor = new ImageUploader('imgoneback_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgOneBack', 'imgOneBack', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgOneBack_GenerateFileName_insert', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgOneBack',
                'upload/%id%/',
                Delegate::CreateFromMethod($this, 'imgOneBack_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgOneAlt field
            //
            $editor = new TextEdit('imgonealt_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('ImgOneAlt', 'imgOneAlt', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgTwoFront field
            //
            $editor = new ImageUploader('imgtwofront_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgTwoFront', 'imgTwoFront', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgTwoFront_GenerateFileName_insert', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgTwoFront',
                '',
                Delegate::CreateFromMethod($this, 'imgTwoFront_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgTwoBack field
            //
            $editor = new ImageUploader('imgtwoback_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgTwoBack', 'imgTwoBack', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgTwoBack_GenerateFileName_insert', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgTwoBack',
                'upload/%id%/ ',
                Delegate::CreateFromMethod($this, 'imgTwoBack_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgTwoAlt field
            //
            $editor = new TextEdit('imgtwoalt_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('ImgTwoAlt', 'imgTwoAlt', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgThreeFront field
            //
            $editor = new ImageUploader('imgthreefront_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgThreeFront', 'imgThreeFront', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgThreeFront_GenerateFileName_insert', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgThreeFront',
                'upload/%id%/ ',
                Delegate::CreateFromMethod($this, 'imgThreeFront_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgThreeBack field
            //
            $editor = new ImageUploader('imgthreeback_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgThreeBack', 'imgThreeBack', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgThreeBack_GenerateFileName_insert', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgThreeBack',
                'upload/%id%/ ',
                Delegate::CreateFromMethod($this, 'imgThreeBack_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgThreeAlt field
            //
            $editor = new TextEdit('imgthreealt_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('ImgThreeAlt', 'imgThreeAlt', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgFourFront field
            //
            $editor = new ImageUploader('imgfourfront_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgFourFront', 'imgFourFront', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgFourFront_GenerateFileName_insert', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgFourFront',
                'upload/%id%/ ',
                Delegate::CreateFromMethod($this, 'imgFourFront_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgFourBack field
            //
            $editor = new ImageUploader('imgfourback_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('ImgFourBack', 'imgFourBack', $editor, $this->dataset, false, false, '%id%');
            $editColumn->OnCustomFileName->AddListener('imgFourBack_GenerateFileName_insert', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'imgFourBack',
                'upload/%id%/ ',
                Delegate::CreateFromMethod($this, 'imgFourBack_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(100)
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imgFourAlt field
            //
            $editor = new TextEdit('imgfouralt_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('ImgFourAlt', 'imgFourAlt', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for SKU field
            //
            $column = new TextViewColumn('SKU', 'SKU', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'Updated', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for price field
            //
            $column = new TextViewColumn('price', 'Price', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for manufacturerId field
            //
            $column = new TextViewColumn('manufacturerId', 'ManufacturerId', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for gameSystem field
            //
            $column = new TextViewColumn('gameSystem', 'GameSystem', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for color field
            //
            $column = new TextViewColumn('color', 'Color', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for tag field
            //
            $column = new TextViewColumn('tag', 'Tag', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for game_category field
            //
            $column = new TextViewColumn('category_game_category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for stockQty field
            //
            $column = new TextViewColumn('stockQty', 'StockQty', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for inStock field
            //
            $column = new TextViewColumn('inStock', 'InStock', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for filterVal field
            //
            $column = new TextViewColumn('filterVal', 'FilterVal', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for displayStatus field
            //
            $column = new TextViewColumn('displayStatus', 'Display Status', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for featured field
            //
            $column = new TextViewColumn('featured', 'Featured', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for new field
            //
            $column = new TextViewColumn('new', 'New', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for onSale field
            //
            $column = new TextViewColumn('onSale', 'OnSale', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgOneFront field
            //
            $column = new TextViewColumn('imgOneFront', 'ImgOneFront', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgOneBack field
            //
            $column = new TextViewColumn('imgOneBack', 'ImgOneBack', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgOneAlt field
            //
            $column = new TextViewColumn('imgOneAlt', 'ImgOneAlt', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgTwoFront field
            //
            $column = new TextViewColumn('imgTwoFront', 'ImgTwoFront', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgTwoBack field
            //
            $column = new TextViewColumn('imgTwoBack', 'ImgTwoBack', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgTwoAlt field
            //
            $column = new TextViewColumn('imgTwoAlt', 'ImgTwoAlt', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgThreeFront field
            //
            $column = new TextViewColumn('imgThreeFront', 'ImgThreeFront', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgThreeBack field
            //
            $column = new TextViewColumn('imgThreeBack', 'ImgThreeBack', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgThreeAlt field
            //
            $column = new TextViewColumn('imgThreeAlt', 'ImgThreeAlt', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgFourFront field
            //
            $column = new TextViewColumn('imgFourFront', 'ImgFourFront', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgFourBack field
            //
            $column = new TextViewColumn('imgFourBack', 'ImgFourBack', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for imgFourAlt field
            //
            $column = new TextViewColumn('imgFourAlt', 'ImgFourAlt', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for SKU field
            //
            $column = new TextViewColumn('SKU', 'SKU', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'Updated', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for price field
            //
            $column = new TextViewColumn('price', 'Price', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for manufacturerId field
            //
            $column = new TextViewColumn('manufacturerId', 'ManufacturerId', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for gameSystem field
            //
            $column = new TextViewColumn('gameSystem', 'GameSystem', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for color field
            //
            $column = new TextViewColumn('color', 'Color', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for tag field
            //
            $column = new TextViewColumn('tag', 'Tag', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for game_category field
            //
            $column = new TextViewColumn('category_game_category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for stockQty field
            //
            $column = new TextViewColumn('stockQty', 'StockQty', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for inStock field
            //
            $column = new TextViewColumn('inStock', 'InStock', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for filterVal field
            //
            $column = new TextViewColumn('filterVal', 'FilterVal', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for displayStatus field
            //
            $column = new TextViewColumn('displayStatus', 'Display Status', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for featured field
            //
            $column = new TextViewColumn('featured', 'Featured', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for new field
            //
            $column = new TextViewColumn('new', 'New', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for onSale field
            //
            $column = new TextViewColumn('onSale', 'OnSale', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgOneFront field
            //
            $column = new TextViewColumn('imgOneFront', 'ImgOneFront', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgOneBack field
            //
            $column = new TextViewColumn('imgOneBack', 'ImgOneBack', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgOneAlt field
            //
            $column = new TextViewColumn('imgOneAlt', 'ImgOneAlt', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgTwoFront field
            //
            $column = new TextViewColumn('imgTwoFront', 'ImgTwoFront', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgTwoBack field
            //
            $column = new TextViewColumn('imgTwoBack', 'ImgTwoBack', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgTwoAlt field
            //
            $column = new TextViewColumn('imgTwoAlt', 'ImgTwoAlt', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgThreeFront field
            //
            $column = new TextViewColumn('imgThreeFront', 'ImgThreeFront', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgThreeBack field
            //
            $column = new TextViewColumn('imgThreeBack', 'ImgThreeBack', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgThreeAlt field
            //
            $column = new TextViewColumn('imgThreeAlt', 'ImgThreeAlt', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgFourFront field
            //
            $column = new TextViewColumn('imgFourFront', 'ImgFourFront', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgFourBack field
            //
            $column = new TextViewColumn('imgFourBack', 'ImgFourBack', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for imgFourAlt field
            //
            $column = new TextViewColumn('imgFourAlt', 'ImgFourAlt', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function imgOneFront_Thumbnail_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgOneFront_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgOneBack_Thumbnail_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgOneBack_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgTwoFront_Thumbnail_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgTwoFront_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgTwoBack_Thumbnail_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/ ');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        
        public function imgTwoBack_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgThreeFront_Thumbnail_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/ ');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgThreeFront_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgThreeBack_Thumbnail_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/ ');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgThreeBack_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgFourFront_Thumbnail_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/ ');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgFourFront_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function imgFourBack_Thumbnail_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/ ');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgFourBack_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgOneFront_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgOneFront_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgOneBack_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgOneBack_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgTwoFront_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgTwoFront_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgTwoBack_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/ ');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        
        public function imgTwoBack_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgThreeFront_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/ ');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgThreeFront_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgThreeBack_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/ ');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgThreeBack_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imgFourFront_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/ ');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgFourFront_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function imgFourBack_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'upload/%id%/ ');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function imgFourBack_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '%id%');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVarablesMapToTemplate('%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        public function ShowEditButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        
        public function ShowDeleteButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'products_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'productsGrid');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setExportListAvailable(array('excel','word','xml','csv','pdf'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('excel','word','xml','csv','pdf'));
    
            //
            // Http Handlers
            //
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_description_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for tag field
            //
            $column = new TextViewColumn('tag', 'Tag', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_tag_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgOneFront field
            //
            $column = new TextViewColumn('imgOneFront', 'ImgOneFront', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgOneFront_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgOneBack field
            //
            $column = new TextViewColumn('imgOneBack', 'ImgOneBack', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgOneBack_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgOneAlt field
            //
            $column = new TextViewColumn('imgOneAlt', 'ImgOneAlt', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgOneAlt_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgTwoFront field
            //
            $column = new TextViewColumn('imgTwoFront', 'ImgTwoFront', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgTwoFront_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgTwoBack field
            //
            $column = new TextViewColumn('imgTwoBack', 'ImgTwoBack', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgTwoBack_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgTwoAlt field
            //
            $column = new TextViewColumn('imgTwoAlt', 'ImgTwoAlt', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgTwoAlt_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgThreeFront field
            //
            $column = new TextViewColumn('imgThreeFront', 'ImgThreeFront', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgThreeFront_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgThreeBack field
            //
            $column = new TextViewColumn('imgThreeBack', 'ImgThreeBack', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgThreeBack_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgThreeAlt field
            //
            $column = new TextViewColumn('imgThreeAlt', 'ImgThreeAlt', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgThreeAlt_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgFourFront field
            //
            $column = new TextViewColumn('imgFourFront', 'ImgFourFront', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgFourFront_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgFourBack field
            //
            $column = new TextViewColumn('imgFourBack', 'ImgFourBack', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgFourBack_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgFourAlt field
            //
            $column = new TextViewColumn('imgFourAlt', 'ImgFourAlt', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgFourAlt_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_description_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for tag field
            //
            $column = new TextViewColumn('tag', 'Tag', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_tag_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgOneFront field
            //
            $column = new TextViewColumn('imgOneFront', 'ImgOneFront', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgOneFront_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgOneBack field
            //
            $column = new TextViewColumn('imgOneBack', 'ImgOneBack', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgOneBack_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgOneAlt field
            //
            $column = new TextViewColumn('imgOneAlt', 'ImgOneAlt', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgOneAlt_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgTwoFront field
            //
            $column = new TextViewColumn('imgTwoFront', 'ImgTwoFront', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgTwoFront_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgTwoBack field
            //
            $column = new TextViewColumn('imgTwoBack', 'ImgTwoBack', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgTwoBack_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgTwoAlt field
            //
            $column = new TextViewColumn('imgTwoAlt', 'ImgTwoAlt', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgTwoAlt_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgThreeFront field
            //
            $column = new TextViewColumn('imgThreeFront', 'ImgThreeFront', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgThreeFront_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgThreeBack field
            //
            $column = new TextViewColumn('imgThreeBack', 'ImgThreeBack', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgThreeBack_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgThreeAlt field
            //
            $column = new TextViewColumn('imgThreeAlt', 'ImgThreeAlt', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgThreeAlt_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgFourFront field
            //
            $column = new TextViewColumn('imgFourFront', 'ImgFourFront', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgFourFront_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgFourBack field
            //
            $column = new TextViewColumn('imgFourBack', 'ImgFourBack', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgFourBack_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for imgFourAlt field
            //
            $column = new TextViewColumn('imgFourAlt', 'ImgFourAlt', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'productsGrid_imgFourAlt_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }
    }



    try
    {
        $Page = new productsPage("products.php", "products", GetCurrentUserGrantForDataSource("products"), 'UTF-8');
        $Page->SetTitle('Products');
        $Page->SetMenuLabel('Products');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("products"));
        GetApplication()->SetEnableLessRunTimeCompile(GetEnableLessFilesRunTimeCompilation());
        GetApplication()->SetCanUserChangeOwnPassword(
            !function_exists('CanUserChangeOwnPassword') || CanUserChangeOwnPassword());
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e->getMessage());
    }
	
