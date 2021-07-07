/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
	config.toolbarGroups = [
		{ name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
		{ name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph'] },
		{ name: 'links', groups: ['links'] },
		{ name: 'insert', groups: ['insert'] },
		'/',
		{ name: 'styles', groups: ['styles'] },
		{ name: 'colors', groups: ['colors'] },
		{ name: 'tools', groups: ['tools'] },
		{ name: 'others', groups: ['others'] },
		{ name: 'clipboard', groups: ['clipboard', 'undo'] },
		{ name: 'document', groups: ['mode', 'document', 'doctools'] },
		{ name: 'about', groups: ['about'] }
	];

	config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Underline,Subscript,Superscript,CopyFormatting,RemoveFormat,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Smiley,SpecialChar,PageBreak,Iframe,Styles,Font,BGColor,About,ShowBlocks,Flash';
};

CKEDITOR.replace('ckeditor');