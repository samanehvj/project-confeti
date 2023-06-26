    <div class="form-main">
        <form action="index.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="assignmentId" value="<?=$_GET['aId']?>">
            <input type="hidden" name="controller" value="assignments">
            <input type="hidden" name="action" value="submitSA">
            <div class="fieldgroup">
                <label>Upload File</label>
                <input type="file" name="filename">
            </div> 
            <div class="fieldgroup">
                <label>File Description</label>
                <textarea name="description"></textarea>
            </div>

            <input type="submit" value="Upload Assignment" name="Submit">
        </form>
    </div> <!--.form-main-->