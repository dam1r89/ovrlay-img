'use strict';

chrome.runtime.onInstalled.addListener(function(details) {

});

chrome.browserAction.onClicked.addListener(initialiseOverlay);

function initialiseOverlay() {
    chrome.tabs.query({
        active: true,
        currentWindow: true
    }, function(tabs) {
        chrome.tabs.sendMessage(tabs[0].id, {
            toggle: true
        }, function(response) {

        });
    });
}
