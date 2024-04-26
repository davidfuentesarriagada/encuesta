HashMap<String, Equipo> tablaPosiciones = new HashMap<>();
tablaPosiciones.put("Equipo A", new Equipo("Equipo A"));
tablaPosiciones.put("Equipo B", new Equipo("Equipo B"));


tablaPosiciones.get("Equipo A").actualizarEstadisticas(golesFavor, golesContra);
