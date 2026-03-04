VERSION 5.00

Begin VB.Form Message
    Caption = "Form1"
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    BorderStyle = 1
    LinkTopic = "Form1"
    MaxButton = 0              'False
    MinButton = 0              'False
    ClientLeft   = 45
    ClientTop    = 330
    ClientWidth  = 3960
    ClientHeight = 1080
    StartupPosition = 2
    Begin VB.CommandButton Command1
        Caption = "???"
        Left   = 2640
        Top    = 600
        Width  = 1095
        Height = 375
        TabIndex = 2
    End
    Begin VB.CommandButton Command2
        Caption = "?C"
        Left   = 1440
        Top    = 600
        Width  = 1095
        Height = 375
        TabIndex = 1
    End
    Begin VB.CommandButton Command3
        Caption = "??UC?"
        Left   = 240
        Top    = 600
        Width  = 1095
        Height = 375
        TabIndex = 0
    End
    Begin VB.Label Label1
        ForeColor = 32768
        Left   = 120
        Top    = 120
        Width  = 3735
        Height = 255
        TabIndex = 3
        Alignment = 2
    End
End
