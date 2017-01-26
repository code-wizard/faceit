<?php

use yii\helpers\Url;

/* @var $this yii\web\View */


$this->title = 'Welcome to Faceit';
?>
<link href="https://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">
<!--<script type="text/javascript" src="<?= Url::base()?>/js/faceit.controller.js"></script>-->


<div class="site-index" data-ng-controller="ImageDownloadCtrl" ng-cloak ng-init="init()">

    <div class="jumbotron">
        <h1 class="app-name">Faceit</h1>

        <form class="form-inline" name="form">
          <div class="form-group">
            <input type="text"  name="url" class="form-control" id="url-text"  ng-model="urlText" placeholder="Enter valid image url">
          </div>
          <button type="button"class="btn btn-success" id="add-url" ng-disabled="urlArray.length === maxUrl" ng-click="addUrl()">Add Url</button>
          <button type="button" class="btn btn-primary" ng-disabled="urlArray.length === 0" id="add-url" ng-click="downloadFiles()">Download</button>
        </form>
 
    <div class="body-content" id="image-list">

        <div class="row">
            <div class="col-md-6 col-md-offset-3" >
                <div >
                    <div ng-show="submitted">
                        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div ng-show="showMessage">
                        <span  ng-bind="message"></span>
                        <div>
                            No of images downloaded: <span ng-bind="noOfImages"></span>
                        </div>
                        <div>
                            No of faces found: <span ng-bind="noOfFaces"></span>
                        </div>
                    </div>
                </div>
                
                <ul class="list-group">
                  <li class="list-group-item" ng-repeat="u in urlArray track by $index">
                    <span  style="cursor:pointer" class="tool glyphicon glyphicon-trash" ng-click="delete($index)"></span>
                    {{ u }}
                  </li>
                  <!-- <li class="list-group-item" ng-if="urlArray.length === 0">
                      <strong>You have not added any link</strong>
                  </li> -->
                  <li class="list-group-item" ng-if="urlArray.length === maxUrl">
                      <div class="alert alert-danger"><strong>You can add maximum {{ maxUrl }} urls at a time.</strong></div>
                  </li>
                  <li class="list-group-item" ng-show="error">
                      <div class="alert alert-danger"><strong>{{ error }}</strong></div>
                  </li>
                </ul>


            </div>
            <div class="col-md-7">
            <h2>Click on any image to reveal face.</h2>
                <section id="">
                        <ul class="image-container">
                            <li class="box-item" dir-paginate="iu in imageUrls|itemsPerPage:10 ">
                                <a class="pointer" ng-click="detect(iu.id)"><img ng-src="{{ iu.link }}" ></a>
                            </li> 
                            
                        </ul>
                        <dir-pagination-controls></dir-pagination-controls>
                </section>
            </div>
            <div class="col-md-5">
                    <div id="wrapper">
                        
                    </div>
            </div>
        </div>


    </div>
</div>
