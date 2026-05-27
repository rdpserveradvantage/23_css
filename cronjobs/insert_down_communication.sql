
UPDATE down_communication dc
JOIN (
    SELECT panelid, MAX(rtime) AS last_rtime
    FROM wsites
    GROUP BY panelid
) w ON dc.panel_id = w.panelid
SET dc.dc_date = w.last_rtime;


-- insert_down_communication.sql
-- INSERT INTO down_communication (atm_id, panel_id, dc_date)
-- SELECT a.ATMID, a.NewPanelID, b.rtime
-- FROM sites a
-- JOIN wsites b ON a.NewPanelID = b.panelid
-- WHERE a.server_ip = 21
--   AND b.rtime >= DATE_SUB(NOW(), INTERVAL 1 HOUR);
