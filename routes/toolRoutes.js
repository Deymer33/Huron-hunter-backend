const express = require ("express");
const Tool = require("../models/toolModels");

const router = express.Router();

router.post("/add", async (req, res) =>{
    try{
        const { name, description, category, url, tags} = req.body;
        const newTool = new Tool({name, description, category, url, tags});

       await newTool.save();
        rest.status(201).json({message:"new tool adde", tool: newTool});
    }catch (error) {
        res.status(500).json({error:"error to adde new tool"});
    }
});

module.exports = router; 