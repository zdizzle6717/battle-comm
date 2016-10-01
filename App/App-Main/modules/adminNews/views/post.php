<div class="full_width">
	<h2>News Contributor</h2>
</div>
<div class="four_column_3 single-product">
    <h2>Post ID: {{Post.currentPost.id}}</h2>
    <fieldset class="full_width" ng-disabled="Post.readOnly">
        <form class="formoid-default-skyblue side_by_side" style="margin:0 auto;" name="postForm" novalidate>
            <h2 class="push-bottom">View/Edit</h2>
			<div class="form-group">
				<div class="three_column_2">
	                <label for="title" class="sublabel required">Title:</label>
	                <input id="title" name="title" ng-model="Post.currentPost.title" type="text" class="formTextfield_Large" placeholder="Post name..." required>
	            </div>
			</div>
			<div class="form-group">
				<div class="three_column_1" ng-if="Post.isNew">
	                <label for="manufacturerId" class="sublabel required">Manufacturer ID:</label>
	                <select name="manufacturerId" id="manufacturerId" ng-model="Post.currentPost.manufacturer" ng-options="manufacturer as manufacturer.name for manufacturer in Post.manufacturers" ng-change="Post.setMNU(Post.currentPost.manufacturer)" required></select>
	            </div>
	            <div class="three_column_1" ng-if="!Post.isNew">
	                <label for="manufacturerId" class="sublabel required">Manufacturer ID:</label>
	                <input name="manufacturerId" id="manufacturerId" ng-model="Post.currentPost.manufacturerId" type="text" class="formTextfield_Large" disabled>
	            </div>
	            <div class="three_column_1" ng-if="Post.isNew">
	                <label for="gameSystem" class="sublabel required">Game System ID:</label>
	                <select name="gameSystem" id="gameSystem" ng-model="Post.currentPost.gameSystem" ng-options="system.searchValue as system.name for system in Post.currentMNU.gameSystem" ng-disabled="!Post.currentPost.manufacturer || Post.selectedMNU.name === 'Show All...'" required></select>
	            </div>
				<div class="three_column_1" ng-if="!Post.isNew">
	                <label for="gameSystem" class="sublabel required">Game System ID:</label>
	                <input name="gameSystem" id="gameSystem" ng-model="Post.currentPost.gameSystem" type="text" class="formTextfield_Large" disabled></select>
	            </div>
				<div class="three_column_1">
	                <label for="category" class="sublabel required">Category:</label>
	                <input id="category" name="category" ng-model="Post.currentPost.category" type="text" class="formTextfield_Large" placeholder="Choose a Category..." required>
	            </div>
			</div>
			<div class="form-group">
				<div class="full_width">
	                <label for="callout" class="sublabel required">Post Summary:</label>
	                <textarea id="callout" name="callout" ng-model="Post.currentPost.callout" type="text" class="formTextfield_Large" placeholder="Summarize the article or copy/paste the news post here to auto summarize..." maxlength="750" required></textarea>
	            </div>
			</div>
			<div class="form-group">
				<div class="full_width">
	                <label for="body" class="sublabel required">Post Body:</label>
	                <textarea id="body" name="body" ng-model="Post.currentPost.body" type="text" class="formTextfield_Large" placeholder="Type or copy/paste the news post here..." required></textarea>
	            </div>
			</div>
			<div class="form-group">
				<div class="full_width">
	                <label for="tags" class="sublabel required">Tags:</label>
	                <input id="tags" name="tags" ng-model="Post.currentPost.tags" type="text" class="formTextfield_Large" placeholder="Comma separated tags..." required>
	            </div>
			</div>
			<div class="form-group">
				<!-- <div class="full_width">
	                <div class="three_column_1">
	                    <label>Image Alt (meta name for Google Search):</label>
	                    <input id="imgAlt" name="imgAlt" ng-model="Post.currentPost.imgAlt" type="text" class="formTextfield_Large" placeholder="Enter a meta title for the image..." required>
	                </div>
	            </div> -->
			</div>

            <fieldset>
                <div class="full_width">
                    <div class="three_column_1">
                        <label for="image" class="sublabel required">Featured Image (front):</label>
                        <img ng-src="/uploads/news/{{Post.currentPost.image}}" ng-if="Post.currentPost.image"/>
                    </div>
                    <div class="three_column_1">
                        <label>Image Path:</label>
                        <input id="imgAlt" name="imgAlt" ng-model="Post.currentPost.image" type="text" class="formTextfield_Large" disabled required>
                    </div>
                    <div class="three_column_1">
                        <div file-upload ratio="24:15" model="Post.currentPost.image" param="'news'"></div>
                    </div>
                </div>
            </fieldset>
        </form>
    </fieldset>
</div>
<div class="four_column_1 single-product">
    <div class="panel panel-default sidebar-menu" >
        <div class="panel-body" style="text-align:center;">
            <button ng-click="Post.editPost()" ng-if="Post.readOnly" class="btn btn-to-cart" type="button">Edit Details</button>
            <button ng-click="Post.savePost(Post.currentPost, postForm)" ng-if="!Post.readOnly" class="btn btn-to-cart" type="button" ng-disabled="postForm.$invalid">Save Changes</button>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Featured?</h3>
            <select name="featured" id="featured" ng-model="Post.currentPost.featured" selected="Post.currentPost.featured" ng-disabled="Post.readOnly">
              <option value="true">Yes</option>
              <option value="false">No</option>
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">Published?</h3>
            <select name="published" id="published" ng-model="Post.currentPost.published" selected="Post.currentPost.published" ng-disabled="Post.readOnly">
              <option value="true">Yes</option>
              <option value="false">No</option>
            </select><br>
        </div>
        <div class="panel-body" ng-if="!Post.isNew">
            Updated: {{Post.currentPost.updatedAt | jsonDate | date: 'medium'}}
        </div>
    </div>
    <div class="panel panel-default sidebar-menu" ng-if="Post.readOnly">
        <div class="panel-body" style="text-align:center;">
            <button ng-click="Post.showDeleteModal(Post.currentPost.id)" class="btn btn-to-cart" type="button">Remove Post</button>
            <div delete-record-modal delete="Post.removePost(Post.currentPost.id)">
                <div class="small-12 text-right">
                    <i class="fa fa-times" ng-click="Post.hideDeleteModal()"></i>
                </div>
                <h4>Delete this movie record?</h4>
            </div>
        </div>
    </div>
</div>
