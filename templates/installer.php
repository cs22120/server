<?php include 'header.php'; ?>
<div class="page-header">
  <h1>Installation</h1>
</div>
<p class="lead">Before you can use the Walking Tour Displayer, you need to configure it correctly.</p>
<p>Enter correct credentials for the MySQL server below.</p>
<form class="form-horizontal" method="post" action="">
    <div class="form-group">
      <div class="col-sm-3">
        <label class="control-label" for="dbAddr">Database address</label>
      </div>
      <div class="col-sm-9">
        <input type="text" name="address" class="form-control" id="dbAddr" placeholder="localhost:3306" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label class="control-label" for="dbUsername">Database username</label>
     </div>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="database" id="dbUsername" placeholder="root" required>
    </div>
    </div>

    <div class="form-group">
      <div class="col-sm-3">
      <label class="control-label" for "dbPassword">Database password</label>
      </div>
      <div class="col-sm-9">
      <input type="password" class="form-control" name="password" id="dbPassword" placeholder="hunter2" required>
        </div>
    </div>

    <div class="form-group">
       <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
        <label>
            <input type="checkbox" checked="checked" name="createtables"> Attempt to create tables
        </label>
    </div>
    </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
           <button type="submit" class="btn btn-primary">Begin installation</button> </form>
        </div>
    </div>
</form>
