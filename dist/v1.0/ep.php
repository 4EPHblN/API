<?php
namespace OpenCartWebAPI;
include "./config/config.php";
include "./config/includes.php";

$app = new OpenCartWebAPI();

//region SETTINGS ROUTES
$app->route("settings", 'READ', function () {
    $model = new ModelSetting();
    $model->sendResponse($model->getSettings());
});
//endregion

//region PRODUCT ROUTES
$app->route("products", 'READ', function () {
    $model = new ModelProduct();
    $model->sendResponse($model->getProductsListFull());
});

$app->route("products", 'CREATE', function () {
    $model = new ModelProduct();
    $model->sendResponse($model->addProduct($_POST['content']));
});

$app->route("products/{[0-9]+}", 'READ', function ($matches) {
    $model = new ModelProduct();
    $model->sendResponse($model->getProduct($matches));
});

$app->route("products/{[0-9]+}", 'UPDATE', function ($matches) {
    $model = new ModelProduct();
    $model->sendResponse($model->updateProduct($matches, $_POST['content']));
});

$app->route("products/{[0-9]+}", 'DELETE', function ($matches) {
    $model = new ModelProduct();
    $model->sendResponse($model->deleteProduct($matches));
});

//    $app->route("products/{[0-9]+}/images", 'CREATE', function ($matches) {
//        $model = new ModelFile();
//        $model->sendResponse($model->saveImage($_POST['content']));
//    });
//endregion

//region CATEGORY ROUTES
$app->route("categories", 'READ', function () {
    $model = new ModelCategory();
    $model->sendResponse($model->getCategoriesList());
});
//endregion

//region LANGUAGE ROUTES
$app->route("languages", 'READ', function () {
    $model = new ModelLanguage();
    $model->sendResponse($model->getLanguages());
});
//endregion

//region CURRENCY ROUTES
$app->route("currencies", 'READ', function () {
    $model = new ModelCurrency();
    $model->sendResponse($model->getCurrencies());
});
//endregion

//region FILE ROUTES
$app->route("images", 'CREATE', function () {
    $model = new ModelFile();
    $model->sendResponse($model->saveImage($_POST['content']));
});
//endregion

//region FILTER ROUTES
$app->route("filters", 'CREATE', function () {
    $model = new ModelFilter();
    $model->sendResponse($model->addFilter($_POST['content']));
});

$app->route("filters", 'READ', function () {
    $model = new ModelFilter();
    $model->sendResponse($model->getFilterGroupsFull());
});

$app->route("filters/{[0-9]+}", 'READ', function ($matches) {
    $model = new ModelFilter();
    $model->sendResponse($model->getFilterGroupFull($matches));
});

$app->route("filters/{[0-9]+}", 'UPDATE', function ($matches) {
    $model = new ModelFilter();
    $model->sendResponse($model->editFilter($matches, $_POST['content']));
});

$app->route("filters/{[0-9]+}", 'DELETE', function ($matches) {
    $model = new ModelFilter();
    $model->sendResponse($model->deleteFilter($matches));
});
//endregion

//region OPTION ROUTES
$app->route("options", Actions::$CREATE, function () {
    $model = new ModelOption();
    $model->sendResponse($model->addOption($_POST['content']));
});

$app->route("options", Actions::$READ, function () {
    $model = new ModelOption();
    $model->sendResponse($model->getOptionsFull(), $model->result['total']);
});

$app->route("options/{[0-9]+}", Actions::$READ, function ($matches) {
    $model = new ModelOption();
    $model->sendResponse($model->getOptionFull($matches));
});

$app->route("options/{[0-9]+}", Actions::$UPDATE, function ($matches) {
    $model = new ModelOption();
    $model->sendResponse($model->editOption($matches, $_POST['content']));
});

$app->route("options/{[0-9]+}", Actions::$DELETE, function ($matches) {
    $model = new ModelOption();
    $model->sendResponse($model->deleteOption($matches));
});
//endregion

//region ATTRIBUTES ROUTES
$app->route("attributegroups", Actions::$CREATE, function () {
    $model = new ModelAttribute();
    $model->sendResponse($model->addAttributeGroup($_POST['content']));
});

$app->route("attributegroups", Actions::$READ, function () {
    $model = new ModelAttribute();
    $model->sendResponse($model->getAttributeGroupsFull());
});

$app->route("attributegroups/{[0-9]+}", Actions::$READ, function ($matches) {
    $model = new ModelAttribute();
    $model->sendResponse($model->getAttributeGroupFull($matches));
});

$app->route("attributegroups/{[0-9]+}", Actions::$UPDATE, function ($matches) {
    $model = new ModelAttribute();
    $model->sendResponse($model->editAttributeGroup($matches, $_POST['content']));
});

$app->route("attributegroups/{[0-9]+}", Actions::$DELETE, function ($matches) {
    $model = new ModelAttribute();
    $model->sendResponse($model->deleteAttributeGroup($matches));
});
//    ==================================================================
$app->route("attributes", Actions::$CREATE, function () {
    $model = new ModelAttribute();
    $model->sendResponse($model->addAttribute($_POST['content']));
});

$app->route("attributes", Actions::$READ, function () {
    $model = new ModelAttribute();
    $model->sendResponse($model->getAttributesFull());
});

$app->route("attributes/{[0-9]+}", Actions::$READ, function ($matches) {
    $model = new ModelAttribute();
    $model->sendResponse($model->getAttributeFull($matches));
});

$app->route("attributes/{[0-9]+}", Actions::$UPDATE, function ($matches) {
    $model = new ModelAttribute();
    $model->sendResponse($model->editAttribute($matches, $_POST['content']));
});

$app->route("attributes/{[0-9]+}", Actions::$DELETE, function ($matches) {
    $model = new ModelAttribute();
    $model->sendResponse($model->deleteAttribute($matches));
});
//    ==================================================================
$app->route("attributegroups/{[0-9]+}/attributes", Actions::$READ, function ($matches) {
    $model = new ModelAttribute();
    $model->sendResponse($model->getAttributesByAttributeGroupFull($matches));
});
//endregion

$app->handle();


