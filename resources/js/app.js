import './bootstrap';

import Alpine from 'alpinejs';

import Editor from '@toast-ui/editor'
import '@toast-ui/editor/dist/toastui-editor.css';

window.Alpine = Alpine;

Alpine.start();

const editor = new Editor({
  el: document.querySelector('#editor'),
  height: '50pc',
  initialEditType: 'markdown',
  placeholder: 'Enter your notes...',
  initialValue: '',
});

let hasEditor = document.body.contains(document.querySelector('#new_page_form'));
if(hasEditor) {
    // This is used to inject the markdown contents into the form on the create page
    document.querySelector('#new_page_form').addEventListener('submit', e => {
        e.preventDefault();
        document.querySelector('#content').value = editor.getMarkdown() || '';
        e.target.submit();
    });
}

let hasUpdateEditor = document.body.contains(document.querySelector('#edit_page_form'));
if(hasUpdateEditor) {
    // This is used to inject the markdown contents into the form on the create page
    document.querySelector('#edit_page_form').addEventListener('submit', e => {
        e.preventDefault();
        document.querySelector('#content').value = editor.getMarkdown() || '';
        e.target.submit();
    });
}

let hasTemplateEditor = document.body.contains(document.querySelector('#new-template'));
if(hasTemplateEditor){
    // This is used to inject the markdown contents into the form on the template create page
    document.querySelector('#new-template').addEventListener('submit', e => {
        e.preventDefault();
        document.querySelector('#template').value = editor.getMarkdown();
        e.target.submit();
    });
}

// Any actions for when the page loads can go here.
document.addEventListener("DOMContentLoaded", (event) => {
    document.querySelector('#editor').value = document.querySelector('#content').value || '';
    editor.setMarkdown(document.querySelector('#content').value || '');

    let hasEditTemplateEditor = document.body.contains(document.querySelector('#edit-template'));
    if(hasEditTemplateEditor){
        // This is used to inject the markdown contents into the form on the template create page
        document.querySelector('#editor').value = document.querySelector('#content').value || '';
        editor.setMarkdown(document.querySelector('#content').value || '');
    }
});

document.querySelector('#share_form').addEventListener('show.bs.modal', e => {
    // e.preventDefault();
    // document.querySelector('#page').value = editor.getMarkdown() || '';
    // e.target.submit();
    alert('shown');
});
