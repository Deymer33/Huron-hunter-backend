const searchService = require("../services/searchService");

exports.search = async (req, res) => {
  try {
    const query = req.query.query; // Captura el texto de búsqueda
    if (!query) {
      return res.status(400).json({ message: "Debe proporcionar un término de búsqueda" });
    }

    const results = await searchService.search(query);
    res.json(results);
  } catch (error) {
    console.error("Error en searchController:", error);
    res.status(500).json({ message: "Error interno del servidor" });
  }
};
