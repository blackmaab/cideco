

function LoadGrid()
{


    mygrid = new dhtmlXGridObject('gridbox');
    mygrid.setImagePath("../../../components/grid/imgs/");
    mygrid.init();
    mygrid.setSkin("dhx_skyblue");
    //mygrid.loadXML("../../../components/grid/grid.xml");
	
    mygrid.loadXML("../actions/municipio_grid.php");
	
	
	
/*
	
	
	mygrid = new dhtmlXGridObject('gridbox');
	mygrid.setSkin("dhx_skyblue");
	mygrid.setImagePath("../../../imgs/");
	
	mygrid.setHeader("Col1,col2,col3,col4");
	mygrid.setInitWidths("100,100,100,100");
	mygrid.setColAlign("left,left,left,left");
	mygrid.setColTypes("ro,ro,ro,ro");
	mygrid.setColSorting("str,str,str,str");
	
	
	
	*/
	
//mygrid.loadXML("../common/grid.xml");

// 


}
