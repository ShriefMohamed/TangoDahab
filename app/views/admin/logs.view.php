<?php if (isset($logs) && $logs != null) : ?>
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Manage Logs</strong>
        </div>

        <div class="card-body">
            <div class="alert alert-success" role="alert" style="padding: .75rem .75rem 0.75rem .75rem">
                <?php $logs = explode('*', $logs); ?>
                <textarea class="js-copytextarea"><?php foreach ($logs as $log) : ?><?= $log  ?><?php endforeach; ?></textarea>
                <hr>
                <button type="button" class="js-textareacopybtn btn btn-secondary">
                    Copy to Clipboard
                </button>
            </div>
        </div>
        <style>
            .js-copytextarea {z-index: auto;position: relative;transition: none 0s ease 0s;
                display: block;width: 95%;padding: .375rem .75rem;font-size: 1rem;
                line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;
                border: 1px solid #ced4da;border-radius: .25rem;resize: none;min-height: 330px;}
        </style>
        <script>
            var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

            copyTextareaBtn.addEventListener('click', function(event) {
                var copyTextarea = document.querySelector('.js-copytextarea');
                copyTextarea.focus();
                copyTextarea.select();

                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                    alert('Copying text command was ' + msg);
                } catch (err) {
                    alert('Oops, unable to copy');
                }
            });
        </script>


    </div>
<?php endif; ?>