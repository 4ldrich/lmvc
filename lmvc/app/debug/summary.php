<!-- <!-- Lollipop Debug -->
<div id="lollipop-debugbox" class="lollipop-debug">
    <table>
        <tr>
            <td>
                <a id="lollipop-debug-controller-min" style="display: none;" href="javascript: void(0);">[minimize]</a>
            </td>
            <td>
                <b><?= $app->name ?></b> [<?= $app->version ?>]<br>by <?= $app->author ?>
            </td>
        </tr>
        <tr>
            <td><label class="lollipop-label">Response Time:</label></td>
            <td><label class="lollipop-green"><?= $debug->response->time ?>s</label></td>
        </tr>
        <tr>
            <td><label class="lollipop-label">Memory Used:</label></td>
            <td><label class="lollipop-green"><?= $debug->response->memory_used ?></label></td>
        </tr>
        <tr>
            <td><label class="lollipop-label">Files:</label></td>
            <td><a class="ldebug-toggle" ldebug-toggle="ldebug-tab-files" href="javascript: void(0);"><?= count(get_included_files()) ?> Total File(s)</a></td>
        </tr>
        <tr id="ldebug-tab-files" style="display: none;">
            <td></td>
            <td><div class="container"><?= implode('<br>', get_included_files()) ?></div></td>
        </tr>
        <?php if (count(\Lollipop\Log::get('error'))) { ?>
        <!-- Errors -->
        <tr class="error">
            <td><label class="lollipop-label">Error(s):</label></td>
            <td><a class="ldebug-toggle" ldebug-toggle="ldebug-tab-errors" href="javascript: void(0);"><?= count(\Lollipop\Log::get('error')) ?> Total</a></td>
        </tr>
        <tr id="ldebug-tab-errors" style="display: none;">
            <td></td>
            <td><div class="container"><?= implode('<br>', \Lollipop\Log::get('error')) ?></div></td>
        </tr>
        <?php } ?>
        <?php if (count(\Lollipop\Log::get('warn'))) { ?>
        <!-- Warning -->
        <tr class="warning">
            <td><label class="lollipop-label">Warning(s):</label></td>
            <td><a class="ldebug-toggle" ldebug-toggle="ldebug-tab-warning" href="javascript: void(0);"><?= count(\Lollipop\Log::get('warn')) ?> Total</a></td>
        </tr>
        <tr id="ldebug-tab-warning" style="display: none;">
            <td></td>
            <td><div class="container"><?= implode('<br>', \Lollipop\Log::get('warn')) ?></div></td>
        </tr>
        <?php } ?>
        <?php if (count(\Lollipop\Log::get('notice'))) { ?>
        <!-- Notice -->
        <tr class="notice">
            <td><label class="lollipop-label">Notice(s):</label></td>
            <td><a class="ldebug-toggle" ldebug-toggle="ldebug-tab-notice" href="javascript: void(0);"><?= count(\Lollipop\Log::get('notice')) ?> Total</a></td>
        </tr>
        <tr id="ldebug-tab-notice" style="display: none;">
            <td></td>
            <td><div class="container"><?= implode('<br>', \Lollipop\Log::get('notice')) ?></div></td>
        </tr>
        <?php } ?>
        <?php if (count(\Lollipop\Log::get('info'))) { ?>
        <!-- Infos -->
        <tr class="info">
            <td><label class="lollipop-label">Info Message(s):</label></td>
            <td><a class="ldebug-toggle" ldebug-toggle="ldebug-tab-info" href="javascript: void(0);"><?= count(\Lollipop\Log::get('info')) ?> Total</a></td>
        </tr>
        <tr id="ldebug-tab-info" style="display: none;">
            <td></td>
            <td><div class="container"><?= implode('<br>', \Lollipop\Log::get('info')) ?></div></td>
        </tr>
        <?php } ?>
    </table>
</div>
<style type="text/css">
    .lollipop-debug {
        font-family: Menlo,Monaco,Lucida Console,Liberation Mono,DejaVu Sans Mono,Bitstream Vera Sans Mono,Courier New,monospace,serif;
        font-size: 12px;
        border: 2px blue solid;
        padding: 6px;
        background-color: #dedede;
        max-width: 97%;
        bottom: 0%;
        right: 0%;
        z-index: 2147483647;
        position: fixed;
    }
    
    .lollipop-debug .container {
        width: 100%;
        max-height: 100px;
        overflow: auto;
    }
    
    .lollipop-debug > table {
        font-family: inherit;
        font-size: inherit;
        border-collapse: collapse;
        max-width: 100%;
    }
    
    .lollipop-green {
        color: green;
    }
    
    .lollipop-label {
        color: #4d4d4d;
    }
    
    #ldebug-tab-errors {
        color: red;
    }
    
    #ldebug-tab-warning {
        color: #b97a07;
    }
    
    #ldebug-tab-notice {
        color: #77770a;
    }
    
    #ldebug-tab-info {
        color: #0d568a;
    }
</style>
<!-- End of Lollipop Debug -->
<script type="text/javascript">
    /**
     * Lollipop Debug Toggles
     * 
     */
    window.LollipopDebug = {
        /**
         * Tabs toggle
         * 
         */
        toggles: document.querySelectorAll('.ldebug-toggle'),
        /**
         * Minimize button
         * 
         */
        buttonMinimize: document.querySelectorAll('#lollipop-debug-controller-min'),
        /**
         * initialize events
         * 
         */
        init: function() {
            // toggle for tabs
            for (var j = 0; j < this.toggles.length; j++) {
                if (this.toggles[j]) {
                    this.toggles[j].onclick = function() {
                        var _target_name = this.getAttribute('ldebug-toggle');
                        var _target = document.querySelectorAll('#' + _target_name);

                        if (_target) {
                            for (var i = 0; i < _target.length; i++) {
                                _target[i].style.display = '';
                            }
                        }

                        if (window.LollipopDebug.buttonMinimize) {
                            for (var i = 0; i < window.LollipopDebug.buttonMinimize.length; i++) {
                                window.LollipopDebug.buttonMinimize[i].style.display = '';
                            }
                        }
                    }
                }
            }

            // Set Minimize button events
            if (window.LollipopDebug.buttonMinimize) {
                for (var i = 0; i < window.LollipopDebug.buttonMinimize.length; i++) {
                    window.LollipopDebug.buttonMinimize[i].onclick = function() {
                        var _tabs = document.querySelectorAll('[id^=ldebug-tab-]');

                        for (var k = 0; k < _tabs.length; k++) {
                            _tabs[k].style.display = 'none';
                        }

                        this.style.display = 'none';
                    }
                }
            }
        }
    };

    if (typeof window.LollipopDebug !== typeof undefined) {
        window.LollipopDebug.init(); // initialize lollipop debug events
    }
</script>