VERSION 5.00

Begin VB.Form FActivite
    Caption = "C??OC?"
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    BorderStyle = 1
    LinkTopic = "Form1"
    MaxButton = 0              'False
    MinButton = 0              'False
    ClientLeft   = 45
    ClientTop    = 330
    ClientWidth  = 8220
    ClientHeight = 1785
    RightToLeft = -1              'True
    StartupPosition = 2
    Begin VB.CommandButton Command2
        Left   = 120
        Top    = 960
        Width  = 1455
        Height = 615
        TabIndex = 8
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 9,75
            Charset       = 178
            Weight        = 700
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        Picture = FActivite.frx:0000
        Style = 1
    End
    Begin VB.CommandButton Command11
        Left   = 120
        Top    = 1080
        Width  = 375
        Height = 375
        TabIndex = 7
        Picture = FActivite.frx:0456
        Style = 1
    End
    Begin VB.CommandButton Command10
        Left   = 480
        Top    = 1080
        Width  = 375
        Height = 375
        TabIndex = 6
        Picture = FActivite.frx:083C
        Style = 1
    End
    Begin VB.CommandButton Command9
        Left   = 840
        Top    = 1080
        Width  = 375
        Height = 375
        TabIndex = 5
        Picture = FActivite.frx:0C2E
        Style = 1
    End
    Begin VB.CommandButton Command8
        Left   = 1200
        Top    = 1080
        Width  = 375
        Height = 375
        TabIndex = 4
        Picture = FActivite.frx:0FC8
        Style = 1
    End
    Begin VB.CommandButton Command1
        Left   = 120
        Top    = 120
        Width  = 1455
        Height = 615
        TabIndex = 3
        Picture = FActivite.frx:13AE
        Style = 1
    End
    Begin VB.Frame Frame1
        Caption = "C??OC?"
        ForeColor = 12583104
        Left   = 2040
        Top    = 240
        Width  = 6015
        Height = 1020
        TabIndex = 1
        RightToLeft = -1              'True
        Begin VB.TextBox Text1
            ForeColor = 12582912
            Left   = 120
            Top    = 240
            Width  = 5655
            Height = 525
            TabIndex = 2
            Alignment = 1
            MaxLength = 50
            DataField = "LibAct"
            BeginProperty Font
                Name          = "MS Sans Serif"
                Size          = 13,5
                Charset       = 178
                Weight        = 400
                Underline     = 0              'False
                Italic        = 0              'False
                Strikethrough = 0              'False
            EndProperty
            RightToLeft = -1              'True
        End
    End
    Begin VB.TextBox Text2
        Left   = 2040
        Top    = 960
        Width  = 735
        Height = 285
        Visible = 0              'False
        Text = "Text2"
        TabIndex = 0
        DataField = "CodeAct"
    End
End
