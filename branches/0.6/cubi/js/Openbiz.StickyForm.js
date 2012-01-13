/**
 * Openbiz Sticky Form class
 */
Openbiz.StickyForm = Openbiz.Form.extend (
{
	collectData: function()
    {
    	formData = this._parent();
        formData = formData + "&_selectedId=" + this.selectedId
    						+ "&text=" +  this.noteText
    						+ "&pos_x=" + this.notePos_x
    						+ "&pos_y=" + this.notePos_y
    						+ "&width=" + this.noteWidth
    						+ "&height=" + this.noteHeight
    						;
        return formData;
    }
});