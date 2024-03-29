Ext.define('FM.view.AbstractWindow',{
    extend: 'Ext.window.Window',
    alias: 'widget.abstractwindow',
    title: 'Edição',
    layout: 'fit',
    autoShow: true,
    modal: true,
    initComponent: function(){

        this.buttons = [{
            text: 'Salve',
            action: 'save',
            iconCls: 'save'
        },
        {
            text: 'Cancel',
            scope: this,
            iconCls: 'cancel',
            handler: this.close
        }];
        this.callParent(arguments);
    }
});
