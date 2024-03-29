Ext.define('FM.view.usuario.List' ,{
    extend	: 'Ext.grid.Panel',
    alias 	: 'widget.usuarioList',
    store	: 'Usuarios',
    title 	: 'Lista os usuários',
    //selModel: {mode: 'MULTI'},
    selModel: Ext.create('Ext.selection.CheckboxModel'),
    columnLines: true,
    tbar :[
        {
            text	: 'Add',
            action	: 'insert',
            iconCls	: 'add',
            itemId	: 'insert'
        }
        ,{
            text	: 'Alterar',
            action	: 'edit',
            iconCls	: 'edit',
            itemId	: 'edit',
            disabled: true
        },
        {
            text	: 'Excluir',
            action	: 'destroy',
            iconCls	: 'delete',
            itemId	: 'delete',
            disabled: true
        }
        ,{
            text	: 'Recarregar',
            action	: 'refresh',
            iconCls	: 'refresh',
            itemId	: 'refresh'
        }
    ],
    columns: [
        Ext.create('Ext.grid.RowNumberer'),
        {header: 'Código'	,  dataIndex: 'id'	,  flex: 1},
        {header: 'Nome'		,  dataIndex: 'nome'	,  flex: 1},
        {header: 'E-mail'	,  dataIndex: 'email'		,  flex: 1}
    ],
    dockedItems: [{
        xtype		: 'pagingtoolbar',
        store		: 'Usuarios',
        dock		: 'bottom',
        displayInfo	: true
    }],

    initComponent: function(){
        this.callParent();
        this.getSelectionModel().on('selectionchange', this.onSelectChange, this);
    },

    onRender: function(){
        this.store.load();
        this.callParent(arguments);
    },

    onSelectChange: function(selModel, selections){
        this.down('#delete').setDisabled(selections.length === 0);
        this.down('#edit').setDisabled(selections.length !== 1);
    }

});
