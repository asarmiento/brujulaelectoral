CKEDITOR.plugins.add('object',
{
    init: function (editor) {
        var pluginName = 'object';
        editor.ui.addButton('object',
            {
                label: 'object',
                command: 'OpenWindow',
                icon: CKEDITOR.plugins.getPath('object') + 'object.png'
            });
        var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
    }
});
function showMyDialog(e) {
    e.insertHtml('{{object}}');
}