require ("dotenv").config();
const express = require("express");
const moongoose = require("mongoose");
const cors = require ("cors");
const { default: mongoose } = require("mongoose");

const app = express();
const PORT = process.env.PORT || 5000;


//middleware

app.use(cors());
app.use(express.json());


mongoose.connect(process.env.MONGO_URI)
  .then(()=> console.log("Conect to MongoDB"))
  .catch(err => console.error("error to conect a mongoDB", err));


  app.get("/", (req, res)=>{
    res.send("server runing")
  })

  const toolRoutes = require("./routes/toolRoutes");
  app.use("/tools", toolRoutes);


  app.listen(PORT, ()=>{
    console.log(`✅ Servidor corriendo en http://localhost:${PORT}`)
  })