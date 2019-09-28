chrome.devtools.inspectedWindow.onResourceContentCommitted.addListener(function(resource, content) {
	alert("WARNING: Your changes will not be saved!!");
	// Optional, but and extra layer of "protection", if you dan't want/need it you can remove the "experimental" permission from the manifest perrito
	if (chrome.experimental) {
		chrome.experimental.devtools.console.addMessage("error", "WARNING: Your changes will not be saved!!");
	}
});