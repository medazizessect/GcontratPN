VERSION 5.00
Object = "{F0D2F211-CCB0-11D0-A316-00AA00688B10}#1.0#0"; "C:\WINDOWS\SysWow64\MSDATLST.OCX"
Object = "{CDE57A40-8B86-11D0-B3C6-00A0C90AEA82}#1.0#0"; "C:\WINDOWS\SysWow64\MSDATGRD.OCX"

Begin VB.Form GFiche
    WindowState = 2
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    LinkTopic = "Form1"
    MDIChild = -1              'True
    ClientLeft   = 60
    ClientTop    = 345
    ClientWidth  = 11880
    ClientHeight = 8490
    RightToLeft = -1              'True
    Begin VB.Frame Frame33
        Caption = "C????C?"
        ForeColor = 12582912
        Left   = 6840
        Top    = 240
        Width  = 5535
        Height = 900
        TabIndex = 1
        RightToLeft = -1              'True
        Begin MSDataListLib.DataCombo DataCombo3
            Left   = 120
            Top    = 240
            Width  = 5295
            Height = 480
            TabIndex = 2
            OleObjectBlob = GFiche.frx:0000
            DataField = "CodeAdr"
        End
    End
    Begin MSDataGridLib.DataGrid DataGrid1
        Left   = 120
        Top    = 0
        Width  = 6585
        Height = 9375
        TabIndex = 0
        OleObjectBlob = GFiche.frx:0000
    End
End
