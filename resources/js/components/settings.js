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
    }
};

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
    settingsScripts.run();
}

mounted();
