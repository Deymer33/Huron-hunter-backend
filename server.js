require("dotenv").config();
const express = require("express");
const cors = require("cors");
const mongoose = require("mongoose");

const app = express();
const PORT = process.env.PORT || 5000;

// Middlewares
app.use(cors());
app.use(express.json());

// Conexión a MongoDB
mongoose.connect(process.env.MONGO_URI)
  .then(() => console.log("✅ Conectado a MongoDB"))
  .catch((err) => console.error("❌ Error conectando a MongoDB:", err));

// Rutas
const searchRoutes = require("./src/routes/searchRoutes");
app.use("/api/search", searchRoutes);

const category = require("./src/routes/categoryRoutes");
app.use("/api/category", category);

// Ruta de prueba
app.get("/", (req, res) => {
  res.send("🔍 Backend del Buscador corriendo...");
});

// Levantar servidor
app.listen(PORT, () => {
  console.log(`🚀 Servidor escuchando en http://localhost:${PORT}`);
});
