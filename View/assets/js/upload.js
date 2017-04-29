var flow = new Flow({
    target:'../Controller/upload.php'
});

var totalFiles = 0;
var arrFiles = new Array();

flow.assignBrowse(document.getElementById('file-browse-button'));
flow.assignDrop(document.getElementById('file-drop-zone'));

function fileObjectToArrayIndex(file){
	var count = 0;
	var index = -1;
	flow.files.forEach(function(tmpFlowFile) {
		if(file.uniqueIdentifier===tmpFlowFile.uniqueIdentifier){
			index = count;
		}
		count++;
	});
	return index;
}

flow.on('fileSuccess', function(file,message){
	var index = fileObjectToArrayIndex(file);
	console.log(file,message+index);
	//getProgress();
	$('#file-title-'+index).css('color', 'green');
});
flow.on('filesSubmitted', function(array) {
	reDrawFiles();
});
flow.on('fileAdded',function(file,event){
	console.log(file,event);
});

function submitUpload(){
	flow.upload();
}

function submitStop(){
	flow.pause();
}
function getProgress(){
	console.log(flow.progress());
	return flow.progress();
}


function reDrawFiles(){
	totalFiles = 0;
	document.getElementById("selected-files-list").innerHTML = '';
	flow.files.forEach(function(tmpFlowFile) {
		addFile(tmpFlowFile);
	});
	document.getElementById("num-files").innerHTML = totalFiles;
}

function addFile(file){
	document.getElementById("selected-files-list").innerHTML = document.getElementById("selected-files-list").innerHTML + '<tr id="file'+totalFiles+'"> 	<td id="file-title-'+totalFiles+'" style="color:grey;"> 		<strong>'+file.name+'</strong> 	</td> 	<td nowrap>'+file.size+' bytes</td> 	<td> 		<div class="progress" style="margin-bottom: 0;"> 			<div class="progress-bar" role="progressbar"></div> 		</div> 	</td> 	<td nowrap> 		<button type="button" class="btn btn-warning btn-xs"> 			<span class="glyphicon glyphicon-ban-circle"></span> Cancel 		</button> 		<button type="button" class="btn btn-danger btn-xs" onclick="removeFile('+totalFiles+');"> 			<span class="glyphicon glyphicon-trash"></span> Remove 		</button> 	</td> </tr>';
	arrFiles[totalFiles] = file;
	totalFiles++;
}

function removeFile(fileNo){
	flow.removeFile(arrFiles[fileNo]);
	reDrawFiles();
}

function removeAllFiles(){
	for(var i=0;i<totalFiles;i++){
		flow.removeFile(arrFiles[i]);
	}
	reDrawFiles();
}