import './bootstrap';

import Alpine from 'alpinejs';

import Editor from '@toast-ui/editor'
import '@toast-ui/editor/dist/toastui-editor.css';


window.Alpine = Alpine;

Alpine.start();

const editor = new Editor({
  el: document.querySelector('#editor'),
  height: '25pc',
  initialEditType: 'markdown',
  placeholder: 'Enter your notes...',
})