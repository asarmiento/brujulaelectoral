CKEDITOR.plugins.add('blaudobject',
{
    init: function (editor) {
        var pluginName = 'blaudobject';
        editor.ui.addButton('blaudobject',
            {
                label: 'Blaud Object (Coloquelo para agregar elementos multimedia)',
                command: 'OpenWindow',
                icon: CKEDITOR.plugins.getPath('blaudobject') + 'blaudobject.png'
            });
        var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
    }
});
function showMyDialog(e) {
    e.insertHtml('{{blaudobject}}');
}