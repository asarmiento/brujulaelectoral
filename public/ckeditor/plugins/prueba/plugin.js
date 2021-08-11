CKEDITOR.plugins.add('prueba',
{
    init: function (editor) {
        var pluginName = 'prueba';
        editor.ui.addButton('prueba',
            {
                label: 'Prueba',
                command: 'OpenWindow',
                icon: CKEDITOR.plugins.getPath('prueba') + 'object.png'
            });
        var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
    }
});
function showMyDialog(e) {
    e.insertHtml('{{object}}');
}