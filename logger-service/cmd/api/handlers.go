package main

import (
	"log-service/data"
	"net/http"
)

type JsonPayload struct {
	Level   string `json:"level"`
	Message string `json:"name"`
	Data    string `json:"data"`
}

func (app *Config) WriteLog(w http.ResponseWriter, r *http.Request) {
	var requestPayload JsonPayload
	_ = app.readJSON(w, r, &requestPayload)

	event := data.LogEntry{
		Level:   requestPayload.Level,
		Message: requestPayload.Message,
		Data:    requestPayload.Data,
	}

	err := app.Models.LogEntry.Insert(event)
	if err != nil {
		app.errorJSON(w, err)
		return
	}

	response := jsonResponse{
		Error:   false,
		Message: "Logged",
	}

	app.writeJSON(w, http.StatusAccepted, response)
}
