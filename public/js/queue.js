var Queue = function()
{
    /*[ Inner array ]*/
    var queue = [];

    /*[ Adds an element to the Queue ]*/
    this.add = function(element) {
        if(Array.isArray(element))
            queue=queue.concat(element);
        else
            queue.push(element);
        
        return this;
    };

    /*[ Adds an element to the Queue ]*/
    this.get = function(element) {
        return queue.shift();
    };

    /*[ Remove the first element from the Queue ]*/
    this.remove = function() {
        queue.shift();
        return this;
    };

    /*[ Retrieve the size of the Queue ]*/
    this.size = function() {
        return queue.length;
    };

    /*[ Check to see whether or not the Queue is empty ]*/
    this.isEmpty = function() {
        return (queue.length == 0);
    };

    /*[ Retrieve the Queue's content ]*/
    this.getQueue = function() {
        return queue;
    };
};
