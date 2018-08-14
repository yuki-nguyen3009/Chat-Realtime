<?php $__env->startSection('additional_css'); ?>
    <style>

        body{
            background-color: #1cbb9b;
        }

        
        .panel-body{
            height: 50vh;
            overflow-y: scroll;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                        <div class="col-md-6">
                        <?php echo e($user->name); ?>

                        </div>
                        <div class="col-md-6">
                        <?php echo e(Form::open(['url'=>route('conversation.store')])); ?>

                        <?php echo e(Form::hidden('user_id',$user->id)); ?>

                        <?php echo e(Form::submit('Add friend',['class'=>'btn btn-primary'])); ?>

                            <hr>
                        <?php echo e(Form::close()); ?>

                        </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Friends</div>

                <div class="panel-body">
                    <?php $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('conversation.show',$conversation->id)); ?>">
                            <?php echo e(($conversation->user1()->first()->id==Auth::user()->id)?$conversation->user2()->first()->name:$conversation->user1()->first()->name); ?>

                        </a>
                        <hr/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>  

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>