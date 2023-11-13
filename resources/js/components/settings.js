var settingsScripts = {
    originals: [],
    run: function() {
        //
    },
    reset: function() {
        let txtSharedWithUsers = document.querySelector('#shared_with_users');
        txtSharedWithUsers.value = this.originals['shared_with_users'];

        let chkPrivate = document.querySelector('#private');
        chkPrivate.checked = this.originals['private'] == 'on' ? true : false;
    },
    copyToClipboard: function() {
        // Get the text field
        var copyText = document.getElementById("public_url");

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);
        this.setCopyMessage('Copied to clipboard');
        setTimeout(function(){
            if(document.body.contains(document.querySelector("#msgCopy"))) {
                document.querySelector('#msgCopy').innerHTML = '';
            }
        }, 5000);
    },

    /**
     * Sets the copy message.
     * @param {*} msg 
     */
    setCopyMessage: function(msg) {
        if(document.body.contains(document.querySelector("#msgCopy"))) {
            document.querySelector('#msgCopy').innerHTML = msg;
        }
    },
};

/**
 * This runs when the page is loaded.
 */
function mounted() {
    if(document.body.contains(document.querySelector('#shared_with_users'))){
        // Save a copy of the original settings.
        settingsScripts.originals['shared_with_users'] = document.querySelector('#shared_with_users').value
        settingsScripts.originals['private'] = document.querySelector('#private').value
    }

    let hasResetButton = document.body.contains(document.querySelector('#btnReset'));
    if(hasResetButton) {
        // This is used to inject the markdown contents into the form on the create page
        document.querySelector('#btnReset').addEventListener('click', e => {
            settingsScripts.reset();
        });
    }

    let hasCopyButton = document.body.contains(document.querySelector('#btnClipboard'));
    if(hasCopyButton) {
        document.querySelector('#btnClipboard').addEventListener('click', e => {
            settingsScripts.copyToClipboard();
        });
    }

    if(document.body.contains(document.querySelector("#msgCopy"))) {
        document.querySelector('#msgCopy').innerHTML = "";
    }
    settingsScripts.run();
}

mounted();
