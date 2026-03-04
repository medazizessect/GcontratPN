VERSION 5.00
Object = "{F0D2F211-CCB0-11D0-A316-00AA00688B10}#1.0#0"; "C:\WINDOWS\SysWow64\MSDATLST.OCX"

Begin VB.Form Choix
    Caption = "C?IC??E ?C????C?"
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    BorderStyle = 1
    LinkTopic = "Form1"
    MaxButton = 0              'False
    MinButton = 0              'False
    ClientLeft   = 45
    ClientTop    = 330
    ClientWidth  = 4710
    ClientHeight = 2685
    RightToLeft = -1              'True
    StartupPosition = 2
    Begin VB.CommandButton Command2
        Left   = 1560
        Top    = 1920
        Width  = 1455
        Height = 615
        TabIndex = 4
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 9,75
            Charset       = 178
            Weight        = 700
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        Picture = Choix.frx:0000
        Style = 1
    End
    Begin VB.Frame Frame33
        Caption = "C????C?"
        ForeColor = 12582912
        Left   = 120
        Top    = 960
        Width  = 4455
        Height = 780
        TabIndex = 2
        RightToLeft = -1              'True
        Begin MSDataListLib.DataCombo DataCombo3
            Left   = 120
            Top    = 240
            Width  = 4215
            Height = 420
            TabIndex = 3
            OleObjectBlob = Choix.frx:0456
            DataField = "CodeAdr"
        End
    End
    Begin VB.Frame Frame11
        Caption = "C?IC??E"
        ForeColor = 12582912
        Left   = 120
        Top    = 120
        Width  = 4455
        Height = 780
        TabIndex = 0
        RightToLeft = -1              'True
        Begin MSDataListLib.DataCombo DataCombo2
            Left   = 120
            Top    = 240
            Width  = 4215
            Height = 420
            TabIndex = 1
            OleObjectBlob = Choix.frx:0456
            DataField = "CodeArr"
        End
    End
End
