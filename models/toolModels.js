const mongoose = require("mongoose");


const toolSchema = new mongoose.Schema({
    name:{
        type: String,
        required: true,
        trim: true
    },
    description:{
        type:String,
        required:true
    },
    category:{
        type:String,
        required:true
    },
    url:{
        type:String,
        required:true
    },
    tags:{
        type: [String],
        default:[]
    }
}, {timestamps: true });

const Tool = mongoose.model("Tool", toolSchema);

module.exports= Tool;