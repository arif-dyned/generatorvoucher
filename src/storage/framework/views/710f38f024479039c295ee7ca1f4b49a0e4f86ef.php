<style>
    div.scrol {
        max-height: 200px;
        overflow: scroll;
    }
</style>
<?php if(session('error')): ?>
    <section style="padding:15px">
        <div class="col-sm-12">
            <div class="alert alert-danger alert-dismissible scrol">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Ooops!</h4>
                <?php echo session('error'); ?>

            </div>
        </div>
    </section>
<?php endif; ?>
<?php if(session('info')): ?>
    <section style="padding:15px">
        <div class="col-sm-12">
            <div class="alert alert-info alert-dismissible scrol">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Info!</h4>
                <?php echo session('info'); ?>

            </div>
        </div>
    </section>
<?php endif; ?>
<?php if(session('warning')): ?>
    <section style="padding:15px">
        <div class="col-sm-12">
            <div class="alert alert-warning alert-dismissible scrol">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Warning!</h4>
                <?php echo session('warning'); ?>

            </div>
        </div>
    </section>
<?php endif; ?>
<?php if(session('success')): ?>
    <section style="padding:15px">
        <div class="col-sm-12">
            <div class="alert alert-success alert-dismissible scrol">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                <?php echo session('success'); ?>

            </div>
        </div>
    </section>
<?php endif; ?>