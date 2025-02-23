const express = require ("express");
const Tool = require("../models/toolModels");
const axios = require("axios");
require("dotenv").config();

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

router.get("/search", async (req, res) => {
    try {
        const { name, category, tag } = req.query;
        let query = {};

        if (name) query.name = { $regex: name, $options: "i" };
        if (category) query.category = category;
        if (tag) query.tags = tag;

        // Buscar herramientas en MongoDB
        const tools = await Tool.find(query);

        // Si no hay herramientas, devolver solo el mensaje
        if (tools.length === 0) {
            return res.json({ message: "No se encontraron herramientas", tools: [] });
        }

        // Crear una descripción para la IA
        const toolDescriptions = tools.map(tool => `${tool.name}: ${tool.description}`).join("\n");

        // Llamar a DeepSeek para generar una recomendación
        const aiResponse = await axios.post(
            "https://api.deepseek.com/v1/chat/completions",
            {
                model: "deepseek-chat",
                messages: [
                    { role: "system", content: "Eres un asistente que recomienda herramientas de manera eficiente." },
                    { role: "user", content: `Con base en estas herramientas:\n${toolDescriptions}\n¿Cuál recomendarías usar primero y en qué orden? Responde con un párrafo corto.` }
                ],
                max_tokens: 150
            },
            {
                headers: {
                    "Authorization": `Bearer ${process.env.DEEPSEEK_API_KEY}`,
                    "Content-Type": "application/json"
                }
            }
        );

        // Enviar la recomendación junto con los resultados
        res.json({
            recommendation: aiResponse.data.choices[0].message.content,
            tools
        });

    } catch (error) {
        console.error(error);
        res.status(500).json({ error: "Error en la búsqueda con IA" });
    }
});



module.exports = router; 