import { getUrlParameter } from './mixins.js'

$(document).ready(function() {
    let packetId = getUrlParameter('packetId')
    console.log(packetId)
})