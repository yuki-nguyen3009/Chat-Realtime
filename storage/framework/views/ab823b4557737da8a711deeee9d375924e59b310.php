<?php $__env->startSection('additional_css'); ?>
    <style>
        .panel-body{
            height: 50vh;
            overflow-y: scroll;
        }
        .message{
            padding: 10pt;
            border-radius: 5pt;
            margin: 5pt;
        }
        .owner{
            background-color: #ccd7e0;
            float: right;
        }
        .not_owner{
            background-color: #eaeff2;
            float:left;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8">
                            <?php echo e(($conversation->user1()->first()->id==Auth::user()->id)?$conversation->user2()->first()->name:$conversation->user1()->first()->name); ?>

                        </div>
                    </div>
                </div>
                <div class="panel-body" id="panel-body">
                    <?php $__currentLoopData = $conversation->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div class="row">
                            <div class="message <?php echo e(($message->user_id!=Auth::user()->id)?'not_owner':'owner'); ?>">
                                <?php echo e($message->text); ?><br/>
                                <b> <?php echo e($message->created_at->diffForHumans()); ?></b>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </div>
                <div class="panel-footer">
                        <textarea id="msg" class="form-control" placeholder="Write your message"></textarea>
                        <input type="hidden" id="csrf_token_input" value="<?php echo e(csrf_token()); ?>"/>
                        <br/>
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                                <button class="btn btn-primary btn-block" onclick="button_send_msg()">Send</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional_js'); ?>
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    <script>
        var socket = io.connect('http://127.0.0.1:8890');
        socket.emit('add user', {'client':<?php echo e(Auth::user()->id); ?>,'conversation':<?php echo e($conversation->id); ?>});

        socket.on('message', function (data) {
            $('#panel-body').append(
                    '<div class="row">'+
                    '<div class="message not_owner">'+
                    data.msg+'<br/>'+
                    '<b>now</b>'+
                    '</div>'+
                    '</div>');

            scrollToEnd();

         });
    </script>
    <script>
        $(document).ready(function(){
            scrollToEnd();

            $(document).keypress(function(e) {
                if(e.which == 13) {
                    var msg = $('#msg').val();
                    $('#msg').val('');//reset
                    send_msg(msg);
                }
            });
        });

        function button_send_msg(){
            var msg = $('#msg').val();
            $('#msg').val('');//reset
            send_msg(msg);
        }


        function send_msg(msg){
            $.ajax({
                headers: { 'X-CSRF-Token' : $('#csrf_token_input').val() },
                type: "POST",
                url: "<?php echo e(route('message.store')); ?>",
                data: {
                    'text': msg,
                    'conversation_id':<?php echo e($conversation->id); ?>,
                },
                success: function (data) {
                    if(data==true){

                        $('#panel-body').append(
                                '<div class="row">'+
                                '<div class="message owner">'+
                                msg+'<br/>'+
                                '<b>ora</b>'+
                                '</div>'+
                                '</div>');

                        scrollToEnd();
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }

        function scrollToEnd(){
            var d = $('#panel-body');
            d.scrollTop(d.prop("scrollHeight"));
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>