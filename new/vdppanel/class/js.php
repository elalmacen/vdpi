<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2007
 */
class js
{

	function openJS()
	{return "<script language=\"javascript\">";}

	function closeJS()
	{return "</script>";}

	function addSelect($name,$place){

		$var = "var divOptions = parent.document.getElementById('$place');
		var lstPaper = parent.document.createElement('select');
		lstPaper.setAttribute('name','$name');
		lstPaper.setAttribute('id','$name');
		divOptions.appendChild(lstPaper);";
		return $var;

	}
	function addSelectAction($name,$place,$do){
		$var = "
		var divOptions = parent.document.getElementById('$place');
		if (navigator.appName == 'Microsoft Internet Explorer')
		{
			var mySelect = parent.document.createElement(\"<select name='$name' id='$name'  onChange='$do' >\");
		}
		else
		{
			var mySelect = parent.document.createElement('select');
			mySelect.setAttribute('name','$name');
			mySelect.setAttribute('onChange','$do');
			mySelect.setAttribute('id','$name');
		}
		divOptions.appendChild(mySelect);
		";
		return $var;
	}
	function addImage($name,$src,$place){
		$var = "
		var divOptions = parent.document.getElementById('$place;');
		var img = parent.document.createElement('img');
		img.setAttribute('name','$name');
		img.setAttribute('id','$name');
		img.setAttribute('src','$src');
		divOptions.appendChild(img);
		";
		return $var;
	}
	function txtButonAction($name,$text,$place,$do){
		$var = "
		var divOptions = parent.document.getElementById('$place');
		if (navigator.appName == 'Microsoft Internet Explorer')
		{
			var myLinkText = parent.document.createElement(\"<input type=submit value='$text' id='$name' onClick='$do' >\");
		}
		else
		{
			var myLinkText = parent.document.createElement('input');
			myLinkText.setAttribute('type','submit');
			myLinkText.setAttribute('value','$text');
			myLinkText.setAttribute('onClick','$do');
			myLinkText.setAttribute('id','$name');
		}
		divOptions.appendChild(myLinkText);
		";
		return $var;
	}
	function txtButonActionImg($name,$src,$place,$do,$alt){
		$var = "
		var divOptions = parent.document.getElementById('$place');
		if (navigator.appName == 'Microsoft Internet Explorer')
		{
			var myLinkText = parent.document.createElement(\"<input type=Image src='$src' id='$name' alt='$alt' onClick='$do' >\");
		}
		else
		{
			var myLinkText = parent.document.createElement('input');
			myLinkText.setAttribute('type','image');
			myLinkText.setAttribute('src','$src');
			mySelect.setAttribute('alt','$alt');
			myLinkText.setAttribute('onClick','$do');
			myLinkText.setAttribute('id','$name');
		}
		divOptions.appendChild(myLinkText);
		";
		return $var;
	}
	function addInputTypeHidden($id,$place,$value){
		$var = "
		var divOptions = parent.document.getElementById('$place');
		var inputHidden = parent.document.createElement('input');
		inputHidden.setAttribute('type','hidden');
		inputHidden.setAttribute('id','$id');
		inputHidden.setAttribute('value','$value');
		divOptions.appendChild(inputHidden);
		";
		return $var;
	}
	function addDivAndText($name,$text,$place){
		$var = addDiv($name,$place);
		$var .= "
		var myText = parent.document.createElement(\"label\");
		myText.innerHTML = '$text';
		div.appendChild(myText);
		";
		return $var;
	}
	function addText($div,$text){
		$var .= "
		var myText = parent.document.createElement(\"label\");
		myText.innerHTML = '$text';
		$div.appendChild(myText);
		";
		return $var;
	}
	function addDiv($name,$place){
		$var .= "
		var divOptions = parent.document.getElementById('$place');
		var div = parent.document.createElement('div');
		div.setAttribute('id','$name');
		divOptions.appendChild(div);
		";
		return $var;
	}
	function addDivStyle($name,$place,$style){
		$var .= "
		var divOptions = parent.document.getElementById('$place');
		var div = parent.document.createElement('div');
		div.setAttribute('id','$name');
		if (navigator.appName == 'Microsoft Internet Explorer')
			div.setAttribute('className','$style');
		else
			div.setAttribute('class','$style');
		divOptions.appendChild(div);
		";
		return $var;
	}
	function  changeSelectedIndex ($newIndex,$lstObj){
		$var .="
		parent.changeSelectedIndex('$newIndex','$lstObj');
		";
		return $var;
	}
	function addItemSelect($itemName,$itemValue,$selectName){
		$var .= "
		parent.appendOptionLast('$itemName','$itemValue','$selectName');
		";
		return $var;
	}
	function removeAllOption($obj){
		$var .= "
		parent.removeAllOption('$obj');
		";
		return $var;
	}
	function deleteAllChilds($obj){
		$var .= "
		parent.deleteAllChilds('$obj');
		";
		return $var;
	}
	function alert($text){
		$var .= "
		parent.alert('$text');
		";
		return $var;

	}
	function changeInputTypeText($obj,$text){
		$var .="
			var htmlObj =parent.document.getElementById('$obj');
			htmlObj.value = '$text';
		";
		return $var;
	}
	function fillTextArea($obj,$text){
		$var .="
			var htmlObj =parent.document.getElementById('$obj');
			htmlObj.value = '$text';
		";
		return $var;
	}

	function removeNode($nodeName,$parentName)
	{
		$var .= "
		var myGalery =parent.document.getElementById('$parentName');
		var myPhotoGalery = parent.document.getElementById('$nodeName');
		myGalery.removeChild(myPhotoGalery);
		";
		return $var;
	}
	function changeDisable($id,$status){
		$var .= "
		var obj =parent.document.getElementById('$id');
		obj.disabled = $status;
		";
		return $var;
	}
	function changeCheckbox($nodeName,$status){
		$var .= "
		var obj =parent.document.getElementById('$nodeName');
		obj.checked  = $status;
		";
		return $var;
	}

}

?>