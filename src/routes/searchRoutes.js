const express = require("express");
const router = express.Router();
const searchController = require("../controllers/searchController");

// GET /api/search?query=...
router.get("/", searchController.search);

module.exports = router;
